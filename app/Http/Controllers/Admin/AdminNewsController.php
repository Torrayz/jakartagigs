<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminNewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
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
            'is_featured' => $request->boolean('is_featured'),
            'views' => 0
        ];

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('images/news', $filename, 'public');
            $data['featured_image'] = $path;
        }

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'News created successfully!');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
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
            'slug' => $this->generateUniqueSlug($request->title, $news->id), // Generate unique slug, exclude current
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'published_at' => $request->published_at,
            'is_featured' => $request->boolean('is_featured')
        ];

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($news->featured_image) {
                Storage::disk('public')->delete($news->featured_image);
            }
            
            $image = $request->file('featured_image');
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('images/news', $filename, 'public');
            $data['featured_image'] = $path;
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'News updated successfully!');
    }

    public function destroy(News $news)
    {
        // Delete image
        if ($news->featured_image) {
            Storage::disk('public')->delete($news->featured_image);
        }
        
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully!');
    }

    /**
     * Generate unique slug for news
     */
    private function generateUniqueSlug($title, $excludeId = null)
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        // Check if slug exists (excluding current record if updating)
        while (true) {
            $query = News::where('slug', $slug);
            
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
