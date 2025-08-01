@extends('admin.layout')

@section('title', 'Manage Highlights - Admin Panel')

@section('content')
<div class="admin-header" style="display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h1 style="color: #fff; margin-bottom: 0.5rem;">Manage Highlights</h1>
        <p style="color: #ccc;">Create, edit, and manage highlights</p>
    </div>
    <a href="{{ route('admin.highlights.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Highlight
    </a>
</div>

<table class="admin-table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Views</th>
            <th>Published</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($highlights as $highlight)
        <tr>
            <td>
                <strong style="color: #fff;">{{ $highlight->title }}</strong>
                <br><small style="color: #ccc;">{{ Str::limit($highlight->excerpt, 50) }}</small>
            </td>
            <td>{{ number_format($highlight->views) }}</td>
            <td>{{ $highlight->published_at->format('M d, Y') }}</td>
            <td>
                <a href="{{ route('admin.highlights.edit', $highlight) }}" class="btn btn-outline" style="margin-right: 0.5rem;">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.highlights.destroy', $highlight) }}" method="POST" style="display: inline;">
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
            <td colspan="4" style="text-align: center; color: #ccc;">No highlights found.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div style="margin-top: 2rem;">
    {{ $highlights->links('pagination.custom') }}
</div>
@endsection
