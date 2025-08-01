@extends('layouts.app')

@section('title', 'Dashboard - JakartaGigsInfo')

@section('content')
<section class="section">
    <div class="section-header">
        <h2 class="section-title">Welcome, {{ auth()->user()->name }}!</h2>
        <p class="section-subtitle">Your personal dashboard</p>
    </div>

    <div class="stats">
        <div class="stat-item">
            <div class="stat-icon"><i class="fas fa-user"></i></div>
            <div class="stat-value">User</div>
            <div class="stat-label">Account Type</div>
        </div>
        <div class="stat-item">
            <div class="stat-icon"><i class="fas fa-calendar"></i></div>
            <div class="stat-value">{{ auth()->user()->created_at->format('M Y') }}</div>
            <div class="stat-label">Member Since</div>
        </div>
        <div class="stat-item">
            <div class="stat-icon"><i class="fas fa-newspaper"></i></div>
            <div class="stat-value">{{ \App\Models\News::count() }}</div>
            <div class="stat-label">Total News</div>
        </div>
        <div class="stat-item">
            <div class="stat-icon"><i class="fas fa-star"></i></div>
            <div class="stat-value">{{ \App\Models\Highlight::count() }}</div>
            <div class="stat-label">Total Highlights</div>
        </div>
    </div>

    <div style="text-align: center; margin-top: 3rem;">
        <a href="{{ route('user.profile') }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit Profile
        </a>
        <a href="{{ route('news') }}" class="btn btn-outline">
            <i class="fas fa-newspaper"></i> Browse News
        </a>
        <a href="{{ route('highlights') }}" class="btn btn-outline">
            <i class="fas fa-star"></i> View Highlights
        </a>
    </div>
</section>
@endsection
