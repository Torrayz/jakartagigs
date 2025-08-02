<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'JakartaGigsInfo - Your Ultimate Music Hub')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">
                <span class="jakarta">Jakarta</span><span class="gigs">Gigs</span><span class="info">Info</span>
            </a>

            <ul class="nav-menu">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('news') }}" class="{{ request()->routeIs('news*') && !request()->routeIs('admin.*') ? 'active' : '' }}">News</a></li>
                <li><a href="{{ route('highlights') }}" class="{{ request()->routeIs('highlights*') && !request()->routeIs('admin.*') ? 'active' : '' }}">Highlights</a></li>
            </ul>

            <div class="search-box">
                <form action="{{ route('search') }}" method="GET">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" name="q" placeholder="Search news, highlights..." value="{{ request('q') }}">
                </form>
            </div>

            <!-- <div class="auth-buttons">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">
                        <i class="fas fa-cog"></i> Admin Panel
                    </a>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Admin Login
                    </a>
                @endauth
            </div> -->
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>
                    <span class="jakarta">Jakarta</span><span class="gigs">Gigs</span><span class="info">Info</span>
                </h4>
                <p>Indonesia's premier music and entertainment platform, connecting you with the heartbeat of Jakarta's vibrant music scene.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div class="footer-section">
                <h4>Categories</h4>
                <ul>
                    <li><a href="{{ route('news') }}">News</a></li>
                    <li><a href="{{ route('highlights') }}">Highlights</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h4>Company</h4>
                <ul>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2024 JakartaGigsInfo. All rights reserved. Made with ❤️ in Jakarta.</p>
        </div>
    </footer>

    <script>
        // Simple search form submission
        document.querySelector('.search-box form').addEventListener('submit', function(e) {
            const input = this.querySelector('input[name="q"]');
            if (!input.value.trim()) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
