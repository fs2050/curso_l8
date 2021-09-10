<a href="{{ route('posts.create')}}">Criar Posts</a>

<h1>Posts</h1>
<hr>
@foreach ($posts as $post)

<p>{{ $post->title }}</p>
<p>{{ $post->content }}</p>
<hr>


@endforeach

