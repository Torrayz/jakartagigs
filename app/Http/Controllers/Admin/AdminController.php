<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Highlight;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_news' => News::count(),
            'total_highlights' => Highlight::count(),
            'total_users' => User::where('role', 'user')->count(),
            'total_views' => News::sum('views') + Highlight::sum('views')
        ];

        $recent_news = News::latest()->take(5)->get();
        $popular_highlights = Highlight::orderBy('views', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_news', 'popular_highlights'));
    }
}
