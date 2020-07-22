@extends('layouts.app')

@section('content')
<div class="container">
    
    <nav>
        <a class="btn btn-light btn-lg" href="{{ action('PostController@userPosts') }}">Mis Publicaciones</a>
    </nav>
    
    @foreach($posts as $post)
    <div class="row pb-4 pt-4 border-bottom">
        <div class="col-md-4 miPost p-0">
            <a href="{{ action('PostController@show', $post->id) }}">
            @if($post->establishment->imagen)
                <img src="{{ Storage::url($post->establishment->imagen[0]) }}" class="card-img-top" alt="...">
            @else
                <h3>No tienes imagenes</h3>
            @endif                 
            </a>
        </div>
        <div class="col-md-8 pl-4">
            <div class="row">
                <div class="col-md-10 pb-4">                    
                    <h5>
                        <a class="text-muted" href="{{route('posts.filtro', ['tipo'=> $post->tipo, 'distrito'=>$post->establishment->distrito])}}">
                            {{$post->establishment->ciudad}} - {{$post->establishment->distrito}}
                        </a>
                    </h5>
                    
                    <h4 class="card-title">
                        <a href="{{ action('PostController@show', $post->id) }}">{{$post->nombre}}</a>
                    </h4>
                    <h5 class="mt-3">
                    @php
                        $features = $post->establishment->features[0]
                    @endphp
                    {{$features->dormitorios}} dormitorios  ·  {{$features->baños}} baños  ·  Piscina: {{$features->piscina}}  ·  Garage: {{$features->garage}}  ·  <a href="{{route('posts.filtro', ['tipo'=> $post->tipo])}}">Tipo: {{$post->tipo}}</a>
                    </h5>
                </div>
                @if($post->user_id === Auth::id())
                <div class="col-md-2 pb-4 row">
                    <div class="col-md-6 p-0">
                        <form method="POST" action="{{ route('post.destroy',$post->id) }}">
                            @csrf
                            @method('DELETE')                
                            <button class="eliminar" type="submit" onclick="return confirm('Sure Want Delete?')">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-md-6 p-0">                    
                        <a href="{{route('post.edit', ['post_id'=> $post->id])}}"><i class="far fa-edit"></i></a>
                    </div>                    
                </div>
                @endif
            </div>
            <div class="row mt-5">
                <div class="col-md-8">
                    <h3>S/. {{$post->establishment->precio}}</h3>
                </div>  
                <div class="col-md-4">                    
                    <h5>Tienes {{count($post->comments)}} comentarios</h5>
                </div>
            </div>                                     
        </div>
    </div>
    @endforeach
</div>
@endsection