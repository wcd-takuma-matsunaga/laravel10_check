<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
//        Eagerローディングしてuser_idがログインユーザーのものを取得
        $posts = Post::with('user')->where('user_id', auth()->id())->get();

        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        $validated['user_id'] = auth()->id();

        $post = Post::create($validated);

        return back()->with('message', '保存しました');
    }
}
