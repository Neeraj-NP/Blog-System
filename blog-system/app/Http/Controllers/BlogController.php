<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('blogs')->get();
        $query = Blog::with('category')->where('is_published', true);

        // AJAX filter
        if ($request->ajax()) {
            if ($request->category_id) {
                $query->where('category_id', $request->category_id);
            }
            if ($request->date) {
                $query->whereDate('created_at', $request->date);
            }
            if ($request->search) {
                $query->where(function ($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->search . '%')
                      ->orWhere('short_description', 'like', '%' . $request->search . '%');
                });
            }

            $blogs = $query->latest()->get();
            return response()->json([
                'html'  => view('blog.partials.blog-cards', compact('blogs'))->render(),
                'count' => $blogs->count(),
            ]);
        }

        $blogs = $query->latest()->paginate(9);
        return view('blog.index', compact('blogs', 'categories'));
    }

    public function show($slug)
    {
        $blog       = Blog::with('category')->where('slug', $slug)->where('is_published', true)->firstOrFail();
        $related    = Blog::with('category')
                        ->where('category_id', $blog->category_id)
                        ->where('id', '!=', $blog->id)
                        ->where('is_published', true)
                        ->latest()
                        ->take(3)
                        ->get();
        $categories = Category::withCount('blogs')->get();
        return view('blog.show', compact('blog', 'related', 'categories'));
    }
}
