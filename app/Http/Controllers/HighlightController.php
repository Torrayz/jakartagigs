<?php

namespace App\Http\Controllers;

use App\Models\Highlight;
use Illuminate\Http\Request;

class HighlightController extends Controller
{
    public function index()
    {
        $highlights = Highlight::published()
            ->popular()
            ->paginate(8);

        return view('highlights.index', compact('highlights'));
    }

    public function show(Highlight $highlight)
    {
        $highlight->increment('views');

        $relatedHighlights = Highlight::where('id', '!=', $highlight->id)
            ->published()
            ->latest()
            ->take(3)
            ->get();

        return view('highlights.show', compact('highlight', 'relatedHighlights'));
    }
}
