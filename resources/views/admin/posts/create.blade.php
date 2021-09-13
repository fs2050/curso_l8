@extends('admin.layouts.app')

@section('title', 'Criar novo post')

@section('content')

<h1>Criar Novo Post</h1>

<form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
    @include('admin.posts._partials.form')


</form>


@endsection

