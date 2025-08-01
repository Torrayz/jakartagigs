@extends('admin.layout')

@section('title', 'News - Admin Panel')

@section('content')
<div class="admin-header" style="display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h1 style="color: #fff; margin-bottom: 0.5rem;">Manage News</h1>
        <p style="color: #ccc;">Create, edit, and manage news articles</p>
    </div>
    <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Article
    </a>
</div>

<table class="admin-table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Views</th>
            <th>Featured</th>
            <th>Published</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($news as $article)
        <tr>
            <td>
                <strong style="color: #fff;">{{ $article->title }}</strong>
                <br><small style="color: #ccc;">{{ Str::limit($article->excerpt, 50) }}</small>
            </td>
            <td>{{ number_format($article->views) }}</td>
            <td>
                @if($article->is_featured)
                    <span style="color: #f59e0b;"><i class="fas fa-star"></i> Featured</span>
                @else
                    <span style="color: #ccc;">Regular</span>
                @endif
            </td>
            <td>{{ $article->published_at->format('M d, Y') }}</td>
            <td>
                <a href="{{ route('admin.news.edit', $article) }}" class="btn btn-outline" style="margin-right: 0.5rem;">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.news.destroy', $article) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align: center; color: #ccc;">No news articles found.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div style="margin-top: 2rem;">
    {{ $news->links('pagination.custom') }}
</div>
@endsection
