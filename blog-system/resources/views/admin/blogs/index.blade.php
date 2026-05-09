@extends('layouts.admin')
@section('title', 'All Blogs')
@section('page-title', '📰 All Blogs')

@section('content')
<div class="panel">
    <div class="panel-header">
        <div class="panel-title"><i class="fas fa-list"></i> Blog Posts ({{ $blogs->total() }})</div>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Blog
        </a>
    </div>
    <div class="panel-body">
        <table>
            <thead>
                <tr>
                    <th width="50">Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th width="130">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                <tr>
                    <td>
                        <div class="blog-thumb">
                            @if($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="thumb">
                            @else
                                <i class="fas fa-newspaper"></i>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div style="font-weight:600; max-width:300px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; font-size:0.9rem;">{{ $blog->title }}</div>
                        <div style="font-size:0.75rem; color:var(--gray-500); margin-top:2px;">{{ Str::limit($blog->short_description, 60) }}</div>
                    </td>
                    <td><span class="badge badge-saffron">{{ $blog->category->name ?? '—' }}</span></td>
                    <td>
                        @if($blog->is_published)
                            <span class="badge badge-green"><i class="fas fa-check"></i> Published</span>
                        @else
                            <span class="badge badge-red">Draft</span>
                        @endif
                    </td>
                    <td style="color:var(--gray-500); font-size:0.82rem;">{{ $blog->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="btn btn-outline btn-sm" title="View"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-secondary btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" onsubmit="return confirm('Delete this blog?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:40px; color:var(--gray-500);">
                        <i class="fas fa-newspaper" style="font-size:2rem; display:block; margin-bottom:10px; opacity:0.3;"></i>
                        No blogs yet. <a href="{{ route('admin.blogs.create') }}" style="color:var(--saffron);">Add one now!</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @if($blogs->hasPages())
        <div style="padding: 16px 20px;">
            {{ $blogs->links('blog.partials.pagination') }}
        </div>
        @endif
    </div>
</div>
@endsection
