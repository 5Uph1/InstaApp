<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')
            ->withCount('likes')
            ->latest()
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'caption' => 'required|string|max:255',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // max dalam KB (2MB)
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $request->user()->posts()->create($validated);

        return redirect()->route('posts.index')
            ->with('success', 'Post berhasil dibuat.');
    }

    public function show(Post $post)
    {
        $post->load('user', 'comments.user');

        return view('posts.show', compact('post'));
    }

    public function edit(Request $request, Post $post)
    {
        if ($post->user_id !== $request->user()->id) {
            abort(403, 'Anda tidak berhak mengedit post ini.');
        }

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== $request->user()->id) {
            abort(403, 'Anda tidak berhak mengedit post ini.');
        }

        $validated = $request->validate([
            'caption' => 'required|string|max:255',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama kalau ada, supaya storage tidak menumpuk file sampah
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($validated);

        return redirect()->route('posts.index')
            ->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy(Request $request, Post $post)
    {
        if ($post->user_id !== $request->user()->id) {
            abort(403, 'Anda tidak berhak menghapus post ini.');
        }

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post berhasil dihapus.');
    }
}