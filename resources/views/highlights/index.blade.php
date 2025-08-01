@extends('layouts.app')

@section('title', 'Highlights - JakartaGigsInfo')

@section('content')
<section class="section">
    <div class="section-header">
        <h2 class="section-title">Popular Highlights</h2>
        <p class="section-subtitle">Most viewed content based on popularity</p>
    </div>

    @if($highlights && $highlights->count() > 0)
        <div class="cards-grid">
            @foreach($highlights as $highlight)
            <div class="card">
                @if($highlight->hasUploadedImage())
                    <!-- Show actual uploaded image -->
                    <img src="{{ $highlight->image_url }}" 
                         alt="{{ $highlight->title }}" 
                         class="card-image"
                         style="width: 100%; height: 200px; object-fit: cover;">
                @else
                    <!-- Show placeholder only if no image -->
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
                        <span><i class="fas fa-calendar"></i> {{ $highlight->published_at->format('M d, Y') }}</span>
                        <span><i class="fas fa-eye"></i> {{ number_format($highlight->views) }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div style="margin-top: 3rem; text-align: center;">
            {{ $highlights->links('pagination.custom') }}
        </div>
    @else
        <div style="text-align: center; padding: 3rem;">
            <p style="color: #ccc; font-size: 1.2rem;">No highlights found.</p>
        </div>
    @endif
</section>
@endsection
