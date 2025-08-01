<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::published()
            ->orderBy('published_at', 'desc')
            ->paginate(8);

        return view('news.index', compact('news'));
    }

    public function show(News $news)
    {
        // Increment views
        $news->increment('views');

        // Get related news (latest 3)
        $relatedNews = News::where('id', '!=', $news->id)
            ->published()
            ->latest()
            ->take(3)
            ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }
}
