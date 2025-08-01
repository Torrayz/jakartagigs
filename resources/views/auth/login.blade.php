@extends('layouts.app')

@section('title', 'Admin Login - JakartaGigsInfo')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Admin Login</h1>
            <p>Sign in to admin panel</p>
        </div>

        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem;">
                <input type="checkbox" id="remember" name="remember" style="width: auto; margin: 0;">
                <label for="remember" style="margin: 0; color: #ccc;">Remember me</label>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-bottom: 1rem;">
                <i class="fas fa-sign-in-alt"></i> Sign In
            </button>
        </form>

        <div style="text-align: center;">
            <p style="color: #999; font-size: 0.9rem;">Admin access only</p>
        </div>
    </div>
</div>
@endsection
