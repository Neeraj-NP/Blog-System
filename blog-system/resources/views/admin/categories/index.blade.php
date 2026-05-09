@extends('layouts.admin')
@section('title', 'Categories')
@section('page-title', '🗂️ Categories')

@section('content')
<div style="display:grid; grid-template-columns: 1fr 1fr; gap:24px; align-items:start; max-width: 860px;">
    <!-- Add Category -->
    <div class="form-card">
        <h3 style="font-family:'Baloo 2',cursive; font-weight:700; margin-bottom:18px; display:flex; align-items:center; gap:8px;">
            <i class="fas fa-plus-circle" style="color:var(--saffron);"></i> Add Category
        </h3>
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Category Name <span>*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. Admit Card, Result..." required>
                @error('name')<div class="error-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Add Category</button>
        </form>
    </div>

    <!-- Categories List -->
    <div class="panel">
        <div class="panel-header">
            <div class="panel-title"><i class="fas fa-list"></i> All Categories ({{ $categories->count() }})</div>
        </div>
        <div class="panel-body">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Blogs</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $cat)
                    <tr>
                        <td style="color:var(--gray-500); font-size:0.82rem;">{{ $loop->iteration }}</td>
                        <td><span class="badge badge-saffron">{{ $cat->name }}</span></td>
                        <td><strong>{{ $cat->blogs_count }}</strong></td>
                        <td>
                            <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST"
                                  onsubmit="return confirm('Delete category \'{{ $cat->name }}\'? This will also delete all related blogs!')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align:center; padding:30px; color:var(--gray-500);">No categories yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
