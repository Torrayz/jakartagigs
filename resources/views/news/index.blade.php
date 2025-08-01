@extends('layouts.app')

@section('title', 'Latest News - JakartaGigsInfo')

@section('content')
<section class="section">
    <div class="section-header">
        <h2 class="section-title">Latest News</h2>
        <p class="section-subtitle">Stay updated with the latest music and entertainment news</p>
    </div>

    @if($news && $news->count() > 0)
        <div class="cards-grid">
            @foreach($news as $article)
            <div class="card">
                @if($article->hasUploadedImage())
                    <!-- Show actual uploaded image -->
                    <img src="{{ $article->image_url }}" 
                         alt="{{ $article->title }}" 
                         class="card-image"
                         style="width: 100%; height: 200px; object-fit: cover;">
                @else
                    <!-- Show placeholder only if no image -->
                    <div style="width: 100%; height: 200px; background: linear-gradient(135deg, #f59e0b, #d97706); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                        <i class="fas fa-image"></i>
                    </div>
                @endif
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

        <!-- Pagination -->
        <div style="margin-top: 3rem; text-align: center;">
            {{ $news->links('pagination.custom') }}
        </div>
    @else
        <div style="text-align: center; padding: 3rem;">
            <i class="fas fa-newspaper" style="font-size: 3rem; color: #666; margin-bottom: 1rem;"></i>
            <p style="color: #ccc; font-size: 1.2rem;">No news articles found.</p>
            <p style="color: #999;">Check back later for updates!</p>
        </div>
    @endif
</section>
@endsection
