@extends('layouts.app')

@section('title', 'Profile - JakartaGigsInfo')

@section('content')
<section class="section">
    <div class="section-header">
        <h2 class="section-title">Profile Settings</h2>
        <p class="section-subtitle">Update your account information</p>
    </div>

    <div style="max-width: 600px; margin: 0 auto;">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="card">
            <div class="card-content">
                <form method="POST" action="{{ route('user.profile.update') }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="password">New Password (leave blank to keep current)</label>
                        <input type="password" id="password" name="password">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation">
                    </div>

                    <div style="display: flex; gap: 1rem;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Profile
                        </button>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-outline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
