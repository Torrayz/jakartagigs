@extends('admin.layout')

@section('title', 'Create News - Admin Panel')

@section('content')
<div class="admin-header">
    <h1 style="color: #fff; margin-bottom: 0.5rem;">Create New Article</h1>
    <p style="color: #ccc;">Add a new news article to the website</p>
</div>

@if($errors->any())
    <div class="alert alert-error">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" required>
        <small id="slug-preview" style="color: #f59e0b; display: block; margin-top: 0.3rem;">
            <i class="fas fa-link"></i> URL: <span id="slug-text">your-article-url</span>
        </small>
    </div>

    <div class="form-group">
        <label for="excerpt">Excerpt</label>
        <textarea id="excerpt" name="excerpt" rows="3" required>{{ old('excerpt') }}</textarea>
        <small style="color: #999;">Short description that appears in article previews</small>
    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <textarea id="content" name="content" rows="10" required>{{ old('content') }}</textarea>
    </div>

    <div class="form-group">
        <label for="featured_image">Featured Image</label>
        <input type="file" id="featured_image" name="featured_image" accept="image/*">
        <small style="color: #999; display: block; margin-top: 0.5rem;">
            Supported formats: JPEG, PNG, GIF, BMP, WebP (Max: 5MB)
        </small>
    </div>

    <div class="form-group">
        <div style="background: rgba(245, 158, 11, 0.05); border: 1px solid rgba(245, 158, 11, 0.2); border-radius: 8px; padding: 1rem;">
            <label style="display: flex; align-items: center; gap: 0.5rem; color: #f59e0b; margin-bottom: 0.5rem;">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} style="width: auto; margin: 0;">
                <span style="font-weight: 600;">Featured Article</span>
            </label>
            <small style="color: #ccc; display: block;">
                <i class="fas fa-info-circle"></i> 
                Featured articles will appear prominently on the homepage and get more visibility to visitors.
            </small>
        </div>
    </div>

    <div class="form-group">
        <label for="published_at">Publish Date</label>
        <input type="datetime-local" id="published_at" name="published_at" value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}">
    </div>

    <div style="display: flex; gap: 1rem;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Create Article
        </button>
        <a href="{{ route('admin.news.index') }}" class="btn btn-outline">Cancel</a>
    </div>
</form>

<script>
// Generate slug preview
document.getElementById('title').addEventListener('input', function(e) {
    const title = e.target.value;
    const slug = title.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '') // Remove special characters
        .replace(/\s+/g, '-') // Replace spaces with hyphens
        .replace(/-+/g, '-') // Replace multiple hyphens with single
        .trim('-'); // Remove leading/trailing hyphens
    
    document.getElementById('slug-text').textContent = slug || 'your-article-url';
});

// File preview
document.getElementById('featured_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const fileInfo = document.createElement('div');
        fileInfo.style.marginTop = '0.5rem';
        fileInfo.style.color = '#f59e0b';
        fileInfo.innerHTML = `
            <i class="fas fa-image"></i> Selected: ${file.name} 
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
