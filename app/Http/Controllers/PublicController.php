<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    public function index(){
        $posts = Post::latest()->paginate(16);
        //dd($posts->toArray());
        return view('welcome', compact('posts'));
    }

    public function feed(){

        $posts = Post::whereIn(
            'user_id',
            auth()->user()->followees->pluck('id')->toArray()
        )->latest()->paginate(16);
        //dd($posts->toArray());
        return view('welcome', compact('posts'));
    }

    public function post(Post $post){
        return view('post', compact('post'));
    }

    public function comment(Post $post, Request $request){
        $comment = new Comment();
        $comment->body = $request->input('body');
        $comment->post()->associate($post);
        $comment->user()->associate(auth()->user());
        $comment->save();
        return redirect()->back();
    }

    public function like(Post $post){
        $like = $post->likes()->where('user_id', auth()->user()->id)->firstOrNew();
        if($like->id === null){
            $like->post()->associate($post);
            $like->user()->associate(auth()->user());
            $like->save();
        } else {
            $like->delete();
        }
        return redirect()->back();
    }

    public function user(User $user){
        return view('user', compact('user'));
    }

    public function follow(User $user){
        if(!$user->authHasFollowed){
            $user->followers()->attach(auth()->user());
        } else {
            $user->followers()->detach(auth()->user());
        }
        return redirect()->back();
    }
}
