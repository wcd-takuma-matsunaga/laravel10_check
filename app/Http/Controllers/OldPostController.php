<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class OldPostController extends Controller
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

    public function show($id)
    {
        $post = Post::find($id);
        return view('post.show', compact('post'));
    }

//    個別投稿記事の編集画面
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

//    個別投稿記事の更新
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        $validated['user_id'] = auth()->id();

        $post->update($validated);

        return back()->with('message', '更新しました');
    }

//    個別投稿記事の削除
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index')->with('message', '削除しました');
    }
}
