<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function listPost() {
        $posts = [];
        if (auth()->user()) {
            $posts = auth()->user()->usersCoolPosts()->latest()->get();
        }
        return view('home', compact('posts'));
    }

    public function createPost(Request $request) {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();

        Post::create($incomingFields);

        return redirect('/');
    }

    public function showEditPost(Post $post){
        if (ownerOfThePost($user, $post)){
            return redirect('/');
        }
        return view('edit-post', compact('post'));
    }

    public function editPost(Post $post, Request $request) {
        if (ownerOfThePost($user, $post)){
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields);

        return redirect("/");
    }
    public function deletePost(Post $post) {
        if (ownerOfThePost($user, $post)){
            return redirect('/');
        }

        $post->delete();

        return redirect("/");
    }

    private function ownerOfThePost($user, $post)
    {
        return $user->id === $post->user_id;
    }
}
