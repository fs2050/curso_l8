<?php

namespace App\Http\Controllers;

use App\Models\Post;

use App\Http\Requests\StoreUpdatePost;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

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
            $nameFile = Str::of($request->title)->slug('-') . '.' . $request->image->getClientOriginalExtension();
            //dd()$image = $request->image->storeAs('posts', $nameFile);
            $image = $request->image->store('posts', 'public');
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
            return redirect()->route('posts.index');
        }
        return view('admin.posts.show', compact('post'));
    }


    public function destroy($id)
    {
        if (!$post = Post::find($id))
            return redirect()->route('posts.index');

        if (Storage::exists('public/' . $post->image))
            Storage::delete('public/' . $post->image);

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

        $data = $request->all();

        if ($request->image && $request->image->isValid()) {

            if (Storage::exists('public/' . $post->image))
                Storage::delete('public/' . $post->image);

            $nameFile = Str::of($request->title)->slug('-') . '.' . $request->image->getClientOriginalExtension();
            //$image = $request->image->storeAs('posts', $nameFile);
            $image = $request->image->store('posts', 'public', $nameFile);
            $data['image'] = $image;
        }

        $post->update($data);

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
