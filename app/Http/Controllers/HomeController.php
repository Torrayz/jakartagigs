<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Highlight;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured articles (if any)
        $featuredArticles = News::featured()
            ->published()
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        // Get latest articles (if any)
        $latestArticles = News::published()
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();

        // Get popular highlights (if any)
        $popularHighlights = Highlight::published()
            ->popular()
            ->take(4)
            ->get();

        return view('home', compact('featuredArticles', 'latestArticles', 'popularHighlights'));
    }
}
