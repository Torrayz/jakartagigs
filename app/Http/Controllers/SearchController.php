<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Highlight;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q');
        
        if (empty($query)) {
            return view('search.index', [
                'query' => '',
                'news' => collect(),
                'highlights' => collect()
            ]);
        }

        $news = News::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->published()
            ->orderBy('published_at', 'desc')
            ->paginate(8, ['*'], 'news_page');

        $highlights = Highlight::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->published()
            ->orderBy('views', 'desc')
            ->paginate(8, ['*'], 'highlights_page');

        return view('search.index', compact('query', 'news', 'highlights'));
    }
}
