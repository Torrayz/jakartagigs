@extends('admin.layout')

@section('title', 'Dashboard - Admin Panel')

@section('content')
<div class="admin-header">
    <h1 style="color: #fff; margin-bottom: 0.5rem;">Dashboard</h1>
    <p style="color: #ccc;">Welcome to JakartaGigsInfo Admin Panel</p>
</div>

<!-- Stats Cards -->
<div class="stats" style="margin-bottom: 3rem;">
    <div class="stat-item">
        <div class="stat-icon"><i class="fas fa-newspaper"></i></div>
        <div class="stat-value">{{ $stats['total_news'] }}</div>
        <div class="stat-label">Total News</div>
    </div>
    <div class="stat-item">
        <div class="stat-icon"><i class="fas fa-star"></i></div>
        <div class="stat-value">{{ $stats['total_highlights'] }}</div>
        <div class="stat-label">Total Highlights</div>
    </div>
    <div class="stat-item">
        <div class="stat-icon"><i class="fas fa-users"></i></div>
        <div class="stat-value">{{ $stats['total_users'] }}</div>
        <div class="stat-label">Users</div>
    </div>
    <div class="stat-item">
        <div class="stat-icon"><i class="fas fa-eye"></i></div>
        <div class="stat-value">{{ number_format($stats['total_views']) }}</div>
        <div class="stat-label">Total Views</div>
    </div>
</div>

<!-- Quick Actions -->
<div style="margin-bottom: 3rem;">
    <h3 style="color: #fff; margin-bottom: 1rem;">Quick Actions</h3>
    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add News
        </a>
        <a href="{{ route('admin.highlights.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Highlight
        </a>
        <a href="{{ route('home') }}" target="_blank" class="btn btn-outline">
            <i class="fas fa-external-link-alt"></i> View Site
        </a>
    </div>
</div>

<!-- Content Overview -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 3rem;">
    <div>
        <h3 style="color: #fff; margin-bottom: 1rem;">Recent News</h3>
        <div class="card">
            <div class="card-content">
                @forelse($recent_news as $news)
                    <div style="padding: 1rem 0; border-bottom: 1px solid rgba(255,255,255,0.1); display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <h4 style="color: #fff; font-size: 0.9rem; margin-bottom: 0.3rem;">{{ Str::limit($news->title, 40) }}</h4>
                            <p style="color: #ccc; font-size: 0.8rem;">{{ $news->created_at->diffForHumans() }}</p>
                        </div>
                        <div style="text-align: right;">
                            <span style="color: #f59e0b; font-size: 0.8rem;">{{ $news->views }} views</span>
                        </div>
                    </div>
                @empty
                    <p style="color: #ccc; text-align: center; padding: 2rem;">No news found. <a href="{{ route('admin.news.create') }}" style="color: #f59e0b;">Create one now</a></p>
                @endforelse
            </div>
        </div>
    </div>

    <div>
        <h3 style="color: #fff; margin-bottom: 1rem;">Popular Highlights</h3>
        <div class="card">
            <div class="card-content">
                @forelse($popular_highlights as $highlight)
                    <div style="padding: 1rem 0; border-bottom: 1px solid rgba(255,255,255,0.1); display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <h4 style="color: #fff; font-size: 0.9rem; margin-bottom: 0.3rem;">{{ Str::limit($highlight->title, 40) }}</h4>
                            <p style="color: #ccc; font-size: 0.8rem;">{{ $highlight->created_at->diffForHumans() }}</p>
                        </div>
                        <div style="text-align: right;">
                            <span style="color: #f59e0b; font-size: 0.8rem;">{{ number_format($highlight->views) }} views</span>
                        </div>
                    </div>
                @empty
                    <p style="color: #ccc; text-align: center; padding: 2rem;">No highlights found. <a href="{{ route('admin.highlights.create') }}" style="color: #f59e0b;">Create one now</a></p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Activity Chart -->
<div>
    <h3 style="color: #fff; margin-bottom: 1rem;">Content Activity</h3>
    <div class="card">
        <div class="card-content" style="padding: 2rem;">
            <div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 1rem; text-align: center;">
                @for($i = 6; $i >= 0; $i--)
                    @php
                        $date = now()->subDays($i);
                        $newsCount = \App\Models\News::whereDate('created_at', $date)->count();
                        $highlightCount = \App\Models\Highlight::whereDate('created_at', $date)->count();
                        $total = $newsCount + $highlightCount;
                        $height = $total > 0 ? min(100, $total * 20) : 10;
                    @endphp
                    <div>
                        <div style="background: linear-gradient(135deg, #f59e0b, #d97706); height: {{ $height }}px; width: 100%; border-radius: 4px; margin-bottom: 0.5rem; display: flex; align-items: end; justify-content: center; color: #fff; font-size: 0.8rem; font-weight: bold;">
                            @if($total > 0) {{ $total }} @endif
                        </div>
                        <p style="color: #ccc; font-size: 0.7rem;">{{ $date->format('M d') }}</p>
                    </div>
                @endfor
            </div>
            <p style="color: #999; text-align: center; margin-top: 1rem; font-size: 0.8rem;">Content created in the last 7 days</p>
        </div>
    </div>
</div>
@endsection
