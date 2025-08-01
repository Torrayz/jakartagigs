@extends('layouts.app')

@section('title', $news->title . ' - JakartaGigsInfo')

@section('content')
<style>
@media (max-width: 768px) {
    .article-grid {
        grid-template-columns: 1fr !important;
    }
}
</style>

<section class="section">
    <div class="article-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 3rem; max-width: 1200px; margin: 0 auto;">
        <!-- Main Article -->
        <article>
            <div class="card-category" style="margin-bottom: 1rem;">NEWS</div>
            
            <h1 style="font-size: 2.5rem; margin-bottom: 1rem; color: #fff; line-height: 1.2;">{{ $news->title }}</h1>
            
            <div class="card-meta" style="margin-bottom: 2rem; font-size: 1rem;">
                <span><i class="fas fa-calendar"></i> {{ $news->published_at->format('M d, Y') }}</span>
                <span><i class="fas fa-eye"></i> {{ number_format($news->views) }} views</span>
            </div>

            @if($news->featured_image)
            <img src="{{ $news->image_url }}" 
                 alt="{{ $news->title }}" 
                 style="width: 100%; height: 400px; object-fit: cover; border-radius: 12px; margin-bottom: 2rem;">
            @endif

            <div style="color: #ccc; line-height: 1.8; font-size: 1.1rem; margin-bottom: 2rem;">
                {!! nl2br(e($news->content)) !!}
            </div>

            <!-- Share Buttons -->
            <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 2rem; margin-top: 2rem;">
                <h4 style="color: #f59e0b; margin-bottom: 1rem;">Share to:</h4>
                <div style="display: flex; gap: 1rem;">
                    <a href="#" class="btn btn-outline" style="background: #1877f2; color: #fff; border: none;">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="btn btn-outline" style="background: #1da1f2; color: #fff; border: none;">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="btn btn-outline" style="background: #0077b5; color: #fff; border: none;">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
        </article>

        <!-- Sidebar -->
        <aside>
            <div style="position: sticky; top: 2rem;">
                <h3 style="color: #f59e0b; margin-bottom: 1.5rem; font-size: 1.5rem;">More News</h3>
                
                @if($relatedNews->count() > 0)
                    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                        @foreach($relatedNews as $related)
                        <div class="card" style="background: rgba(245, 158, 11, 0.05); border: 1px solid rgba(245, 158, 11, 0.2);">
                            <img src="{{ $related->image_url }}" 
                                 alt="{{ $related->title }}" 
                                 style="width: 100%; height: 150px; object-fit: cover;">
                            <div class="card-content" style="padding: 1rem;">
                                <h4 style="color: #fff; font-size: 1rem; margin-bottom: 0.5rem; line-height: 1.3;">
                                    <a href="{{ route('news.show', $related->slug) }}" style="color: inherit; text-decoration: none;">
                                        {{ $related->title }}
                                    </a>
                                </h4>
                                <p style="color: #ccc; font-size: 0.8rem; margin-bottom: 0.5rem;">
                                    {{ Str::limit($related->excerpt, 80) }}
                                </p>
                                <a href="{{ route('news.show', $related->slug) }}" style="color: #f59e0b; font-size: 0.9rem; text-decoration: none; font-weight: 600;">
                                    READ MORE
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
                
                <div style="text-align: right; margin-top: 1rem;">
                    <a href="{{ route('news') }}" style="color: #f59e0b; text-decoration: none; font-weight: 600;">
                        See All
                    </a>
                </div>
            </div>
        </aside>
    </div>
</section>
@endsection
