@extends('layouts.app')

@section('content')
  <div class="container postUnico">
    {{--<link rel="stylesheet" href="{{ asset('css/estilos.css') }}" />--}}
      <div class="imagenes">
        @php
          $aux = 1
        @endphp
        @foreach($data['post']->establishment->imagen as $imagen)
          @if($imagen)
          <div class="imagen-post-unico"  id="imagen{{$aux}}">
            <a target="_blank" href="{{ Storage::url($imagen) }}">
            <img class="img-fluid" src="{{ Storage::url($imagen) }}" class="card-img-top" alt="...">
            </a>
          </div>          
          @endif
        @php
          $aux = $aux +1 
        @endphp
        @endforeach
        @if($data['post']->establishment->imagen == [])
          <h3>No tienes imagenes</h3>
        @endif
      </div>        
      <div class="informacion-post-unico">
        <div class="postHeader">
          <div class="row">
            <div class="col-md-10">
              <h3>{{ $data['post']->nombre }}</h3>
              @php
                $features = $data['post']->establishment->features[0]
              @endphp
              <h5>{{$features->dormitorios}} dormitorios  ·  {{$features->baños}} baños  ·  Piscina: {{$features->piscina}}  ·  Garage: {{$features->garage}}  ·  Tipo: {{$data['post']->tipo}}</h5>
            </div>
            <div class="col-md-2">
              <i></i>            
            </div> 
          </div>         
        </div>
        <div class="postBody">
          <div class="features">
            <div class="row p-0 m-0">
              <div class="col-md-2 offset-md-10 p-0">
                <h6 class="text-muted">{{ $data['post']->created_at->toFormattedDateString() }}</h6>          
              </div>
            </div>          
            <div class="row p-0 m-0 mb-3">
              <div class="col-md-1 p-0 pr-3">
                <img src="{{ Storage::url('iconos//ubicacion.jpg') }}" class="icono"></img>
              </div>

              <div class="col-md-11 p-0">
                <h5><b>Ubicacion</b></h5>
                <h6>{{ $data['post']->establishment->pais }} - {{ $data['post']->establishment->ciudad }} - {{ $data['post']->establishment->distrito }} - {{ $data['post']->establishment->direccion }}</h6>
              </div>
            </div>

            <div class="row p-0 m-0 mb-3">
              <div class="col-md-1 p-0 pr-3">
                <img src="{{ Storage::url('iconos//precio.png') }}" class="icono"></img>
              </div>

              <div class="col-md-11 p-0">
                <h5><b>Precio</b></h5>
                <h6> S/. {{ $data['post']->establishment->precio }}</h6>
              </div>
            </div>

            <div class="row p-0 m-0 mb-3">
              <div class="col-md-1 p-0 pr-3">
                <img src="{{ Storage::url('iconos//pool.png') }}" class="icono"></img>
              </div>

              <div class="col-md-11 p-0">
                <h5><b>Piscina</b></h5>
                <h6>Este establecimiento {{ $features->piscina }} cuenta con piscina</h6>
              </div>
            </div>

            <div class="row p-0 m-0 mb-3">
              <div class="col-md-1 p-0 pr-3">
                <img src="{{ Storage::url('iconos//otros.png') }}" class="icono"></img>
              </div>

              <div class="col-md-11 p-0">
                <h5><b>Otros</b></h5>
                <h6>{{ $features->otros }}</h6>
              </div>
            </div>
          </div>
          <div class="descripcion">
            <h4><b>Descripcion</b></h4>
            <p class="h5 mb-5">{{ $data['post']->descripcion }}</p>
            <h6><b><a href="">Ponte en contacto con el dueño</a></b></h6>
          </div>                                                   
        </div>
      </div>

      <div class="sugeridos">
        @forelse($data['postsRecomendados'] as $postRecomendado)
        <div class="postDisponible mb-5">
          <a href="{{route('post.unico', ['id'=> $postRecomendado->id])}}">
            <img src="{{ Storage::url($postRecomendado->establishment->imagen[0]) }}" class="card-img-top" alt="...">
            <div class="row">
              <div class="col-md-8">
              <h5 class="nombre mt-2">
                {{$postRecomendado->nombre}}
              </h5>
              </div>
              <div class="col-md-4">
              <h5 class="nombre mt-2">
                <b>S/. {{$postRecomendado->establishment->precio}}</b>
              </h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <h6 class="mt-2 text-muted">
                {{$postRecomendado->establishment->ciudad}} - {{$postRecomendado->establishment->distrito}}
                </h6>
              </div>
            </div>
          </a>
        </div>        
        @empty
          <div class="noDisponible">
            <h4>Actualmente no tenemos publicaciones recomendadas para usted</h4>
          </div>
        @endforelse
      </div>

      <div class="comentarios pt-5">
        <h4><b>Comentarios</b></h4>
        @auth
        <form action="{{ action('CommentController@store',['post_id' => $data['post']->id])}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">              
              <div class="col-sm-12 p-0">
                <textarea class="form-control @error ('contenido') is-invalid @enderror p-3 comentarioArea" id="contenido" name="contenido" rows="3" placeholder="Escribe tu comentario">{{ old('Descripcion') }}</textarea>
              @error('contenido')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="form-group">
              <div class="col-sm-12 p-0">
                  <button type="submit" class="btn btn-dark p-2 pl-5 pr-5">
                      {{ __('Enviar') }}
                  </button>
              </div>
          </div>
        </form>
        @endauth
        @guest
          <h5 class="comprobarUsuario pt-3">Si deseas comentar <a href="{{ action('Auth\LoginController@showLoginForm') }}">inicia sesión</a> o <a href="{{ action('Auth\RegisterController@showRegistrationForm') }}">registrate.</a></h5>
        @endguest
        
        <div class="row m-0">
        @forelse ($data['post']->comments as $comment)          
            <div class="col-md-6 p-3 pr-5">
              <div class="row m-0">
                <div class="col-md-2 p-1">
                  @isset($comment->user->img_profile)
                  <img src="{{Storage::url($comment->user->img_profile)}}" alt="" style="width:72px; height:72px; top:10px; left:10px; border-radius:50%">
                  @else
                  <img src="https://static.vecteezy.com/system/resources/previews/000/550/731/non_2x/user-icon-vector.jpg" alt="" style="width:72px; height:72px; top:10px; left:10px; border-radius:50%">
                  @endisset
                </div>
                <div class="col-md-10 p-3">
                  <h5 class="m-0"><b>{{ $comment->user->name }}</b></h5>
                  <p class="text-muted m-0">{{ $comment->created_at->toFormattedDateString() }}</p>
                </div>
              </div>              
              <div class="mt-3">
                <h5>{{ $comment->contenido }}</h5>
              </div>
            </div>          
        @empty
        </div>
          <p>No hay comentarios para esta publicacion , se el primero en hacerlo</p>
        @endforelse 
      </div>     
  </div>
@endsection