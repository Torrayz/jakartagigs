<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - JakartaGigsInfo')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <aside class="admin-sidebar">
            <div style="padding: 0 2rem; margin-bottom: 2rem;">
                <h3 style="color: #f59e0b;">Admin Panel</h3>
                @if(auth()->check())
                    <p style="color: #ccc; font-size: 0.9rem;">{{ auth()->user()->name ?? 'Admin' }}</p>
                @endif
            </div>
            <ul class="admin-nav">
                <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a></li>
                <li><a href="{{ route('admin.news.index') }}" class="{{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i> Manage News
                </a></li>
                <li><a href="{{ route('admin.highlights.index') }}" class="{{ request()->routeIs('admin.highlights.*') ? 'active' : '' }}">
                    <i class="fas fa-star"></i> Manage Highlights
                </a></li>
                <li><a href="{{ route('home') }}" target="_blank">
                    <i class="fas fa-home"></i> View Site
                </a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: #ccc; padding: 1rem 2rem; width: 100%; text-align: left; cursor: pointer;">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </aside>
        
        <main class="admin-content">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
