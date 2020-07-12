@extends('layouts.app')

@section('content')
<div class="container">
    @auth
        <nav>
            <a class="btn btn-light btn-lg" href="">Mis Publicaciones</a>
        </nav>
    @endauth
    @foreach($posts as $post)
    <div class="row mb-4 justify-content-md-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="">{{$post->nombre}}</a>
                    </h5>
                </div>                
                <img src="{{ Storage::url($post->establishment->imagen) }}" class="card-img-top" alt="...">
            </div>
        </div>
    </div>
    @endforeach
    {{ $posts->links()}}
</div>
@endsection