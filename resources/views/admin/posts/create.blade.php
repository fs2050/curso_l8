<h1>Formulario</h1>


@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
        @endforeach
    </ul>
@endif
<form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">

    @csrf
    <input type="text" name="title" id="title" placeholder="Titulo" value="{{old('title')}}">
    <textarea name="content" id="content" cols="30" rows="4" placeholder="Conteudo">{{old('content')}}</textarea>
    <button type="submit" name="enviar">Enviar</button>

</form>
