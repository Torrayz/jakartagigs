@extends('layouts.app')

@section('title', 'Search Results - JakartaGigsInfo')

@section('content')
<section class="section">
    <div class="section-header">
        <h2 class="section-title">
            @if($query)
                Search Results for "{{ $query }}"
            @else
                Search
            @endif
        </h2>
        <p class="section-subtitle">
            @if($query)
                Found {{ $news->total() + $highlights->total() }} results
            @else
                Enter a search term to find news and highlights
            @endif
        </p>
    </div>

    @if($query)
        @if($news->count() > 0)
            <div style="margin-bottom: 3rem;">
                <h3 style="color: #fff; margin-bottom: 1.5rem;">News Results ({{ $news->total() }})</h3>
                <div class="cards-grid">
                    @foreach($news as $article)
                    <div class="card">
                        <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=400&h=300&fit=crop' }}" 
                             alt="{{ $article->title }}" class="card-image">
                        <div class="card-content">
                            <div class="card-category">NEWS</div>
                            <h3 class="card-title">
                                <a href="{{ route('news.show', $article->slug) }}" style="color: inherit; text-decoration: none;">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <p class="card-excerpt">{{ $article->excerpt }}</p>
                            <div class="card-meta">
                                <span><i class="fas fa-calendar"></i> {{ $article->published_at->format('M d, Y') }}</span>
                                <span><i class="fas fa-eye"></i> {{ number_format($article->views) }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div style="margin-top: 2rem; text-align: center;">
                    {{ $news->appends(['q' => $query])->links('pagination.custom') }}
                </div>
            </div>
        @endif

        @if($highlights->count() > 0)
            <div>
                <h3 style="color: #fff; margin-bottom: 1.5rem;">Highlights Results ({{ $highlights->total() }})</h3>
                <div class="cards-grid">
                    @foreach($highlights as $highlight)
                    <div class="card">
                        <img src="{{ $highlight->featured_image ? asset('storage/' . $highlight->featured_image) : 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=400&h=300&fit=crop' }}" 
                             alt="{{ $highlight->title }}" class="card-image">
                        <div class="card-content">
                            <div class="card-category">HIGHLIGHT</div>
                            <h3 class="card-title">
                                <a href="{{ route('highlights.show', $highlight->slug) }}" style="color: inherit; text-decoration: none;">
                                    {{ $highlight->title }}
                                </a>
                            </h3>
                            <p class="card-excerpt">{{ $highlight->excerpt }}</p>
                            <div class="card-meta">
                                <span><i class="fas fa-calendar"></i> {{ $highlight->published_at->format('M d, Y') }}</span>
                                <span><i class="fas fa-eye"></i> {{ number_format($highlight->views) }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div style="margin-top: 2rem; text-align: center;">
                    {{ $highlights->appends(['q' => $query])->links('pagination.custom') }}
                </div>
            </div>
        @endif

        @if($news->count() == 0 && $highlights->count() == 0)
            <div style="text-align: center; padding: 3rem;">
                <i class="fas fa-search" style="font-size: 3rem; color: #666; margin-bottom: 1rem;"></i>
                <p style="color: #ccc; font-size: 1.2rem;">No results found for "{{ $query }}"</p>
                <p style="color: #999;">Try different keywords or browse our categories</p>
            </div>
        @endif
    @else
        <div style="text-align: center; padding: 3rem;">
            <i class="fas fa-search" style="font-size: 3rem; color: #666; margin-bottom: 1rem;"></i>
            <p style="color: #ccc; font-size: 1.2rem;">Start typing to search for news and highlights</p>
        </div>
    @endif
</section>
@endsection
