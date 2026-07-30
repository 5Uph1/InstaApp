<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    // POST /posts/{post}/like
    public function store(Request $request, Post $post)
    {
        $post->likes()->firstOrCreate([
            'user_id' => $request->user()->id,
        ]);

        return redirect()->back()
            ->with('success', 'Post disukai.');
    }

    // DELETE /posts/{post}/like
    public function destroy(Request $request, Post $post)
    {
        $post->likes()
            ->where('user_id', $request->user()->id)
            ->delete();

        return redirect()->back()
            ->with('success', 'Like dibatalkan.');
    }
}