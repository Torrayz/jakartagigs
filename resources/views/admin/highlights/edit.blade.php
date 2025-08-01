@extends('admin.layout')

@section('title', 'Edit Highlight - Admin Panel')

@section('content')
<div class="admin-header">
    <h1 style="color: #fff; margin-bottom: 0.5rem;">Edit Highlight</h1>
    <p style="color: #ccc;">Update the highlight</p>
</div>

<form action="{{ route('admin.highlights.update', $highlight) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="{{ old('title', $highlight->title) }}" required>
        @error('title')<span style="color: #dc2626;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="excerpt">Excerpt</label>
        <textarea id="excerpt" name="excerpt" rows="3" required>{{ old('excerpt', $highlight->excerpt) }}</textarea>
        @error('excerpt')<span style="color: #dc2626;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <textarea id="content" name="content" rows="10" required>{{ old('content', $highlight->content) }}</textarea>
        @error('content')<span style="color: #dc2626;">{{ $message }}</span>@enderror
    </div>

    @if($highlight->featured_image)
    <div class="form-group">
        <label>Current Image</label>
        <img src="{{ asset('storage/' . $highlight->featured_image) }}" alt="Current image" style="max-width: 200px; height: auto; border-radius: 8px;">
    </div>
    @endif

    <div class="form-group">
        <label for="featured_image">Featured Image (leave blank to keep current)</label>
        <input type="file" id="featured_image" name="featured_image" accept="image/*">
        @error('featured_image')<span style="color: #dc2626;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="published_at">Publish Date</label>
        <input type="datetime-local" id="published_at" name="published_at" value="{{ old('published_at', $highlight->published_at->format('Y-m-d\TH:i')) }}">
        @error('published_at')<span style="color: #dc2626;">{{ $message }}</span>@enderror
    </div>

    <div style="display: flex; gap: 1rem;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Update Highlight
        </button>
        <a href="{{ route('admin.highlights.index') }}" class="btn btn-outline">Cancel</a>
    </div>
</form>
@endsection
