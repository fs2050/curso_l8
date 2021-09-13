@extends('admin.layouts.app')
@section('title', 'Listagem dos Posts')

@section('content')
<a href="{{ route('posts.create') }}">Criar Novo Post</a>

<h1>Posts</h1>
<hr>
@if (session('message'))
    <div>
        {{ session('message') }}
    </div>
@endif


<form action=" {{ route('posts.search') }}" method="post">
    @csrf
    <input type='text' name="search" placeholder="Filtrar">
    <button type="submit"> Filtar </button>]
</form>



@foreach ($posts as $post)

<p>
    <img src="{{ url("storage/{$post->image}") }}" alt="{{$post->title }}" style="max-width:100px;">
</p>

    <p>{{ $post->title }}</p>
    <p>{{ $post->content }}
        [ <a href="{{ route('posts.show', $post->id) }}">Ver</a> ] |
        [ <a href="{{ route('posts.edit', $post->id) }}">Edit</a> ]

    </p>
    <hr>


@endforeach

<hr>

@if (isset($filters))

    {{ $posts->appends($filters)->links() }}
@else
    {{ $posts->links() }}
@endif

@endsection
