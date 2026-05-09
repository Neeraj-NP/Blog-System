@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', '📊 Dashboard')

@section('content')
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon orange"><i class="fas fa-newspaper"></i></div>
        <div>
            <div class="stat-value">{{ $totalBlogs }}</div>
            <div class="stat-label">Total Blogs</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-check-circle"></i></div>
        <div>
            <div class="stat-value">{{ $publishedBlogs }}</div>
            <div class="stat-label">Published</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon red"><i class="fas fa-eye-slash"></i></div>
        <div>
            <div class="stat-value">{{ $draftBlogs }}</div>
            <div class="stat-label">Drafts</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon navy"><i class="fas fa-th-large"></i></div>
        <div>
            <div class="stat-value">{{ $totalCategories }}</div>
            <div class="stat-label">Categories</div>
        </div>
    </div>
</div>

<div class="panel">
    <div class="panel-header">
        <div class="panel-title"><i class="fas fa-clock"></i> Recent Blogs</div>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Blog
        </a>
    </div>
    <div class="panel-body">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentBlogs as $blog)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div style="font-weight:600; max-width:280px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                            {{ $blog->title }}
                        </div>
                    </td>
                    <td><span class="badge badge-saffron">{{ $blog->category->name ?? '—' }}</span></td>
                    <td>
                        @if($blog->is_published)
                            <span class="badge badge-green"><i class="fas fa-check"></i> Published</span>
                        @else
                            <span class="badge badge-red"><i class="fas fa-times"></i> Draft</span>
                        @endif
                    </td>
                    <td style="color:var(--gray-500); font-size:0.82rem;">{{ $blog->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
