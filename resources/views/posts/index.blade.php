@extends('layouts.app')

@section('content')
<div class="container container-grid">
    <div class="opciones">
    {{--@auth
        <nav>
            <a class="btn btn-light btn-lg" href="{{action('PostController@userPosts')}}">Mis Publicaciones</a>
        </nav>        
    @endauth--}}

    @include('layouts.filtros')
    </div>
    <div class="contenido">
    @foreach($posts as $post)
    <div class="m-4 justify-content-md-center">        
        <div class="card p-2">
            <a href="{{route('post.unico', ['id'=> $post->id])}}" class="post">
                <img src="{{ Storage::url($post->establishment->imagen[0]) }}" class="card-img-top" alt="...">
                <div class="card-body informacion">
                    <h4 class="card-title">$ {{$post->establishment->precio}}</h4>
                    
                    @foreach ($post->establishment->features as $features)
                    <h6 class="card-text">
                        {{$features->baños}} Bñ. -
                        {{$features->dormitorios}} Dor.
                    </h6>
                    @endforeach                    
                    <h5 class="card-title">{{ $post->nombre }}</h5>
                    <p class="card-text"><small class="text-muted">{{$post->establishment->ciudad}} - {{$post->establishment->distrito}}</small></p>
                </div>                                
            </a>
        </div>
    </div>
    @endforeach
    </div>

    <div class="paginate">
        {{ $posts->links()}}
    </div>
</div>
@endsection