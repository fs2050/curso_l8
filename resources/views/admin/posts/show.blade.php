
@extends('admin.layouts.app')

@section('title', 'Detalhes do Post:')


@section('content')

<h1>Detalhes do Post: {{ $post->title }} </h1>


<ul>
    <li><strong>Titulo:</strong> {{ $post->title }} </li>
    <li><strong>Conteudo</strong> {{ $post->content }}</li>
</ul>


<form action="{{ route('posts.destroy', $post->id) }}" method="post" enctype="multipart/form">
@csrf
    <input type="hidden" name="_method" value="Delete" />

    <button type="submit"> Deletar Post {{ $post->title }} </button>





</form>
@endsection
