@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container container-grid">
    <div class="opciones">
    @include('layouts.filtros')
    </div>
    <div class="contenido">
        @auth        
        <div class="misPosts mr-4">
            <h3 class="m-0">
                <a class="m-0" href="{{action('PostController@userPosts')}}">Mis Publicaciones</a>
            </h3>
        </div>                    
        @endauth
        @foreach($posts as $post)
        <div class="m-4 justify-content-md-center">        
            <div class="card p-2">
                <a href="{{route('post.unico', ['id'=> $post->id])}}" class="post">
                @if($post->establishment->imagen)
                    <img src="{{ Storage::url($post->establishment->imagen[0]) }}" class="card-img-top" alt="...">
                @else
                    <h3>No tienes imagenes</h3>
                @endif                
                    <div class="card-body informacion">
                        <h4 class="card-title">S/. {{$post->establishment->precio}}</h4>
                        
                        @foreach ($post->establishment->features as $features)
                        <h6 class="card-text">
                            {{$features->baños}} Bñ. -
                            {{$features->dormitorios}} Dor.
                        </h6>
                        @endforeach                    
                        <h5 class="card-title nombre">{{ $post->nombre }}</h5>
                        <p class="card-text ubicacion"><small class="text-muted">{{$post->establishment->ciudad}} - {{$post->establishment->distrito}}</small></p>
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