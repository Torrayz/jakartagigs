<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Highlight;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminHighlightController extends Controller
{
    public function index()
    {
        $highlights = Highlight::latest()->paginate(10);
        return view('admin.highlights.index', compact('highlights'));
    }

    public function create()
    {
        return view('admin.highlights.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'required',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,bmp,webp|max:5120',
            'published_at' => 'nullable|date'
        ]);

        $data = [
            'title' => $request->title,
            'slug' => $this->generateUniqueSlug($request->title), // Generate unique slug
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'published_at' => $request->published_at ?: now(),
            'user_id' => auth()->id(),
            'views' => 0
        ];

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('images/highlights', $filename, 'public');
            $data['featured_image'] = $path;
        }

        Highlight::create($data);

        return redirect()->route('admin.highlights.index')->with('success', 'Highlight created successfully!');
    }

    public function edit(Highlight $highlight)
    {
        return view('admin.highlights.edit', compact('highlight'));
    }

    public function update(Request $request, Highlight $highlight)
    {
        $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'required',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,bmp,webp|max:5120',
            'published_at' => 'nullable|date'
        ]);

        $data = [
            'title' => $request->title,
            'slug' => $this->generateUniqueSlug($request->title, $highlight->id), // Generate unique slug
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'published_at' => $request->published_at
        ];

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($highlight->featured_image) {
                Storage::disk('public')->delete($highlight->featured_image);
            }
            
            $image = $request->file('featured_image');
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('images/highlights', $filename, 'public');
            $data['featured_image'] = $path;
        }

        $highlight->update($data);

        return redirect()->route('admin.highlights.index')->with('success', 'Highlight updated successfully!');
    }

    public function destroy(Highlight $highlight)
    {
        // Delete image
        if ($highlight->featured_image) {
            Storage::disk('public')->delete($highlight->featured_image);
        }
        
        $highlight->delete();
        return redirect()->route('admin.highlights.index')->with('success', 'Highlight deleted successfully!');
    }

    /**
     * Generate unique slug for highlights
     */
    private function generateUniqueSlug($title, $excludeId = null)
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        // Check if slug exists (excluding current record if updating)
        while (true) {
            $query = Highlight::where('slug', $slug);
            
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
            
            if (!$query->exists()) {
                break; // Slug is unique
            }
            
            // Add counter to make it unique
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
