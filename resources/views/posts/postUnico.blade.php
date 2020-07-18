@extends('layouts.app')

@section('content')
  <div class="container">
    <div>
      <div class="col-md-8">
        <div class="card">
          <img src="{{ Storage::url($post->establishment->imagen) }}" class="card-img-top" alt="...">
          <div class="card-body">
            <h2 class="card-title">{{ $post->nombre }}</h2>
            <h6 class="card-subtitle mb-2 text-muted">{{ $post->created_at->toFormattedDateString() }}</h6>
            <p class="card-text">{{ $post->descripcion }}</p>
            <div>
            <table>
              <div><h5 class="card-text">{{ $post->establishment->pais }}</h5></div>
              <br>
              <div><h5 class="card-text">{{ $post->establishment->ciudad }}</h5></div>
              <br>
              <div><h5 class="card-text">{{ $post->establishment->distrito }}</h5></div>
              <br>
              <div><h5 class="card-text">{{ $post->establishment->direccion }}</h5></div>
              <br>
              <div><h5 class="card-text">S/. {{ $post->establishment->precio }}</h5></div>
            </table>
            </div>
            <a href="{{ action('PostController@index') }}" class="card-link">Todas las publicaciones </a>
            @if ($post->user_id === Auth::id())
              <a href="{{route('post.edit', ['post_id'=> $post->id])}}" class="card-link">Editar</a>
            @endif
          </div>
        </div>
        @auth
          <form action="{{ action('CommentController@store',['post_id' => $post->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="col-sm-2 col-form-label" for="content">{{ __('Comment') }}</label>
                <div class="col-sm-12">
                <textarea class="form-control @error ('contenido') is-invalid @enderror" id="contenido" name="contenido" rows="3">{{ old('Descripcion') }}</textarea>
                @error('contenido')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create') }}
                    </button>
                </div>
            </div>
          </form>
        @endauth
        @guest
          <p>si deseas comentar <a href="{{ action('Auth\LoginController@showLoginForm') }}">inicia session</a> o <a href="{{ action('Auth\RegisterController@showRegistrationForm') }}">registrate</a></p>
        @endguest
        @forelse ($post->comments as $comment)
          <div class="card">
            <div class="card-body">
              <h5 class="card-tittle">{{ $comment->user->name }}</h5>
              <h6 class="card-subtitle mb-2 text-muted">{{ $comment->created_at->toFormattedDateString() }}</h6>
              <p class="card-text">{{ $comment->contenido }}</p>
            </div>
          </div>
        @empty
          <p>No hay comentarios para esta publicacion , se el priemro en hacerlo</p>
        @endforelse
      </div>
    </div>
  </div>
@endsection