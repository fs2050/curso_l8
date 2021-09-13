
@if ($errors->any())
<ul>
    @foreach ($errors->all() as $error)
        <li>
            {{ $error }}
        </li>
    @endforeach
</ul>
@endif

@csrf
<input type="file" name="image" id="image">
<input type="text" name="title" id="title" placeholder="Titulo" value="{{$post->title ?? old('title')}}">
<textarea name="content" id="content" cols="30" rows="4" placeholder="Conteudo">{{$post->content ?? old('content')}}</textarea>
<button type="submit" name="enviar">Enviar</button>
