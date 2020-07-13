@extends('layouts.app')

@section('content')
<div class="container">
    
    <nav>
        <a class="btn btn-light btn-lg" href="{{ action('PostController@userPosts') }}">Mis Publicaciones</a>
    </nav>
        
    <div class="row mb-4 justify-content-md-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ action('PostController@show', $post->id) }}">{{$post->nombre}}</a>
                    </h5>
                </div>
                <img src="{{ Storage::url($post->establishment->imagen) }}" class="card-img-top" alt="...">
                <div class="custom-file">
                    <input type="file" class="custom-file-input{{ $errors->has('image') ? ' is-invalid':'' }}" id="image" name="image">
                    <label class="custom-file-label" for="customFile">{{__('Escoge una imagen')}}</label>

                    @if ($errors->has('image'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('image')}}</strong>
                        </span>
                    @endif
                </div>
                
                <form method="POST" action="{{ url("posts/{$post->id}") }}">
                    @csrf
                    @method('DELETE')                
                    <button class="btn btn-light btn-block" type="submit">Eliminar Publicación</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection