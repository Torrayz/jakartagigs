@extends('layouts.app')

@section('title', 'JakartaGigsInfo - Latest Music Highlights')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-badge">
        <i class="fas fa-music"></i> Indonesia's #1 Music Platform
    </div>
    
    <h1>Discover Jakarta's Beat</h1>
    
    <p>Your ultimate destination for music news, concert updates, artist spotlights, and the hottest entertainment stories from Jakarta and beyond.</p>
    
    <div class="hero-buttons">
        <a href="{{ route('news') }}" class="btn btn-primary">
            <i class="fas fa-play"></i> Explore Now
        </a>
        <a href="{{ route('highlights') }}" class="btn btn-outline">Latest Highlights</a>
    </div>
</section>

<!-- Latest Articles -->
@if(isset($latestArticles) && $latestArticles->count() > 0)
<section class="section">
    <div class="section-header">
        <h2 class="section-title">Latest News</h2>
        <a href="{{ route('news') }}" class="btn btn-outline">View All <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="cards-grid">
        @foreach($latestArticles as $article)
        <div class="card">
            @if($article->hasUploadedImage())
                <!-- Show uploaded image -->
                <img src="{{ $article->image_url }}" 
                     alt="{{ $article->title }}" 
                     class="card-image"
                     style="width: 100%; height: 200px; object-fit: cover;">
            @else
                <!-- Show placeholder only if no image uploaded -->
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
                    <span>{{ $article->published_at->format('M d, Y') }}</span>
                    <span><i class="fas fa-eye"></i> {{ number_format($article->views) }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@else
<section class="section">
    <div class="section-header">
        <h2 class="section-title">Latest News</h2>
        <a href="{{ route('news') }}" class="btn btn-outline">View All <i class="fas fa-arrow-right"></i></a>
    </div>
    <div style="text-align: center; padding: 2rem;">
        <p style="color: #ccc;">No news articles yet. Check back soon!</p>
    </div>
</section>
@endif

<!-- Popular Highlights -->
@if(isset($popularHighlights) && $popularHighlights->count() > 0)
<section class="section">
    <div class="section-header">
        <h2 class="section-title">Popular Highlights</h2>
        <a href="{{ route('highlights') }}" class="btn btn-outline">View All <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="cards-grid">
        @foreach($popularHighlights as $highlight)
        <div class="card">
            @if($highlight->hasUploadedImage())
                <!-- Show uploaded image -->
                <img src="{{ $highlight->image_url }}" 
                     alt="{{ $highlight->title }}" 
                     class="card-image"
                     style="width: 100%; height: 200px; object-fit: cover;">
            @else
                <!-- Show placeholder only if no image uploaded -->
                <div style="width: 100%; height: 200px; background: linear-gradient(135deg, #f59e0b, #d97706); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                    <i class="fas fa-image"></i>
                </div>
            @endif
            <div class="card-content">
                <div class="card-category">HIGHLIGHT</div>
                <h3 class="card-title">
                    <a href="{{ route('highlights.show', $highlight->slug) }}" style="color: inherit; text-decoration: none;">
                        {{ $highlight->title }}
                    </a>
                </h3>
                <p class="card-excerpt">{{ $highlight->excerpt }}</p>
                <div class="card-meta">
                    <span>{{ $highlight->published_at->format('M d, Y') }}</span>
                    <span><i class="fas fa-eye"></i> {{ number_format($highlight->views) }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@else
<section class="section">
    <div class="section-header">
        <h2 class="section-title">Popular Highlights</h2>
        <a href="{{ route('highlights') }}" class="btn btn-outline">View All <i class="fas fa-arrow-right"></i></a>
    </div>
    <div style="text-align: center; padding: 2rem;">
        <p style="color: #ccc;">No highlights yet. Check back soon!</p>
    </div>
</section>
@endif

<!-- Newsletter -->
<!-- <section class="section">
    <div class="newsletter">
        <h3>Stay in the Loop</h3>
        <p>Get exclusive access to the latest music news, concert announcements, and artist interviews delivered straight to your inbox.</p>
        <form class="newsletter-form">
            <input type="email" placeholder="Enter your email">
            <button type="submit">Subscribe</button>
        </form>
    </div>
</section> -->
@endsection
