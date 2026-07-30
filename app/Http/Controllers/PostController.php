<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // GET /posts -> Feed
    public function index()
    {
        $posts = Post::with('user')
            // ->withCount('likes', 'comments')
            ->latest()
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    // GET /posts/create
    public function create()
    {
        return view('posts.create');
    }

    // POST /posts
    public function store(Request $request)
    {
        $validated = $request->validate([
            'caption' => 'required|string|max:255',
        ]);

        $request->user()->posts()->create($validated);

        return redirect()->route('posts.index')
            ->with('success', 'Post berhasil dibuat.');
    }

    // GET /posts/{post} -> Detail post
    public function show(Post $post)
    {
        $post->load('user', 'comments.user');

        return view('posts.show', compact('post'));
    }

    // GET /posts/{post}/edit
    public function edit(Request $request, Post $post)
    {
        if ($post->user_id !== $request->user()->id) {
            abort(403, 'Anda tidak berhak mengedit post ini.');
        }

        return view('posts.edit', compact('post'));
    }

    // PUT /posts/{post}
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== $request->user()->id) {
            abort(403, 'Anda tidak berhak mengedit post ini.');
        }

        $validated = $request->validate([
            'caption' => 'required|string|max:255',
        ]);

        $post->update($validated);

        return redirect()->route('posts.index')
            ->with('success', 'Post berhasil diperbarui.');
    }

    // DELETE /posts/{post}
    public function destroy(Request $request, Post $post)
    {
        if ($post->user_id !== $request->user()->id) {
            abort(403, 'Anda tidak berhak menghapus post ini.');
        }

        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post berhasil dihapus.');
    }
}