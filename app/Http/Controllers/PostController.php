<?php

namespace App\Http\Controllers;

use App\Models\Post;

use App\Http\Requests\StoreUpdatePost;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::get();
        $posts = Post::orderBy('id', 'asc')->Paginate(5);
        return view('admin.posts.index', compact('posts'));
    }


    public function create()
    {
        return view('admin.posts.create');
    }



    public function store(StoreUpdatePost $request)
    {

         $data = $request->all();
        if ($request->image->isValid()) {
            $nameFile = Str::of($request->title)->slug('-') . '.' .$request->image->getClientOriginalExtension();
            $image = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $image;
        }


        Post::create($data);

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post Criado com Sucesso');;
    }


    public function show($id)
    {
        //dd($id);
        $post = Post::find($id);

        if (!$post) {
            return redirect()->route('post.index');
        }
        return view('admin.posts.show', compact('post'));
    }


    public function destroy($id)
    {
        if (!$post = Post::find($id))
            return redirect()->route('posts.index');

        $post->delete();
        return redirect()
            ->route('posts.index')
            ->with('message', 'Post Deletado com Sucesso');
    }


    public function edit($id)
    {

        if (!$post = Post::find($id)) {
            return redirect()->back();
        }
        return view('admin.posts.edit', compact('post'));
    }




    public function update(StoreUpdatePost $request, $id)
    {

        if (!$post = Post::find($id)) {
            return redirect()->back();
        }

        //dd("editando: {$post->id}");

        $post->update($request->all());

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post Atualizado com Sucesso');
    }


    public function search(Request $request)
    {
        $filters = $request->all();
        $filters = $request->except('_token');

        $posts = Post::where('title', '=', $request->search)

            ->orwhere('content', 'LIKE', "%{$request->search}%")
            ->paginate();

        return view('admin.posts.index', compact('posts', 'filters'));
    }
}
