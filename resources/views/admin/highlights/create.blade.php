@extends('admin.layout')

@section('title', 'Create Highlight - Admin Panel')

@section('content')
<div class="admin-header">
    <h1 style="color: #fff; margin-bottom: 0.5rem;">Create New Highlight</h1>
    <p style="color: #ccc;">Add a new highlight to the website</p>
</div>

<form action="{{ route('admin.highlights.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" required>
        @error('title')<span style="color: #dc2626;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="excerpt">Excerpt</label>
        <textarea id="excerpt" name="excerpt" rows="3" required>{{ old('excerpt') }}</textarea>
        @error('excerpt')<span style="color: #dc2626;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <textarea id="content" name="content" rows="10" required>{{ old('content') }}</textarea>
        @error('content')<span style="color: #dc2626;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="featured_image">Featured Image</label>
        <input type="file" id="featured_image" name="featured_image" accept="image/*">
        @error('featured_image')<span style="color: #dc2626;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="published_at">Publish Date</label>
        <input type="datetime-local" id="published_at" name="published_at" value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}">
        @error('published_at')<span style="color: #dc2626;">{{ $message }}</span>@enderror
    </div>

    <div style="display: flex; gap: 1rem;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Create Highlight
        </button>
        <a href="{{ route('admin.highlights.index') }}" class="btn btn-outline">Cancel</a>
    </div>
</form>
@endsection
