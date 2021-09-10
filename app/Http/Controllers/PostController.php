<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
       // return 'PostController index';
       $posts = Post::get();

    
       //return view('admin.posts.index',['posts' => Post::all()]);
       return view('admin.posts.index', compact('posts'));
    }
}
