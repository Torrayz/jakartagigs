@extends('admin.layout')

@section('title', 'Edit News - Admin Panel')

@section('content')
<div class="admin-header">
    <h1 style="color: #fff; margin-bottom: 0.5rem;">Edit Article</h1>
    <p style="color: #ccc;">Update the news article</p>
</div>

@if($errors->any())
    <div class="alert alert-error">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="{{ old('title', $news->title) }}" required>
    </div>

    <div class="form-group">
        <label for="excerpt">Excerpt</label>
        <textarea id="excerpt" name="excerpt" rows="3" required>{{ old('excerpt', $news->excerpt) }}</textarea>
    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <textarea id="content" name="content" rows="10" required>{{ old('content', $news->content) }}</textarea>
    </div>

    @if($news->featured_image)
    <div class="form-group">
        <label>Current Image</label>
        <div style="margin-bottom: 1rem;">
            <img src="{{ $news->image_url }}" alt="Current image" style="max-width: 300px; height: auto; border-radius: 8px; border: 2px solid rgba(245, 158, 11, 0.3);">
            <p style="color: #ccc; font-size: 0.8rem; margin-top: 0.5rem;">{{ basename($news->featured_image) }}</p>
        </div>
    </div>
    @endif

    <div class="form-group">
        <label for="featured_image">Featured Image {{ $news->featured_image ? '(leave blank to keep current)' : '' }}</label>
        <input type="file" id="featured_image" name="featured_image" accept="image/*">
        <small style="color: #999; display: block; margin-top: 0.5rem;">
            Supported formats: JPEG, PNG, GIF, BMP, SVG, WebP (Max: 5MB)
            <br>Images will be automatically optimized and converted to WebP
        </small>
    </div>

    <div class="form-group">
        <label style="display: flex; align-items: center; gap: 0.5rem;">
            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $news->is_featured) ? 'checked' : '' }} style="width: auto; margin: 0;">
            Featured Article
        </label>
    </div>

    <div class="form-group">
        <label for="published_at">Publish Date</label>
        <input type="datetime-local" id="published_at" name="published_at" value="{{ old('published_at', $news->published_at->format('Y-m-d\TH:i')) }}">
    </div>

    <div style="display: flex; gap: 1rem;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Update Article
        </button>
        <a href="{{ route('admin.news.index') }}" class="btn btn-outline">Cancel</a>
    </div>
</form>

<script>
// Preview image before upload
document.getElementById('featured_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const fileInfo = document.createElement('div');
        fileInfo.style.marginTop = '0.5rem';
        fileInfo.style.color = '#f59e0b';
        fileInfo.innerHTML = `
            <i class="fas fa-image"></i> ${file.name} 
            <span style="color: #ccc;">(${(file.size / 1024 / 1024).toFixed(2)} MB)</span>
        `;
        
        const existing = document.querySelector('.file-preview');
        if (existing) existing.remove();
        
        fileInfo.className = 'file-preview';
        e.target.parentNode.appendChild(fileInfo);
    }
});
</script>
@endsection
