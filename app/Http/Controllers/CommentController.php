<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $post->comments()->create([
            'user_id' => $request->user()->id,
            'comment' => $validated['comment'],
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}