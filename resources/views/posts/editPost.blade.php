@extends('layouts.app')

@section('content')
<div class="container">
    
    <nav>
        <a class="btn btn-light btn-lg" href="{{ action('PostController@userPosts') }}">Mis Publicaciones</a>
    </nav>
        
    <div class="row mb-4 justify-content-md-center">
        <div class="col-md-6">
            <div class="card">
                
                <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">                        
                        <input class="form-control" type="text" name="name" id="name" value="{{$post->nombre}}"> 
                    </div>                
                    <img src="{{ Storage::url($post->establishment->imagen[0]) }}" class="card-img-top" alt="...">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input{{ $errors->has('image') ? ' is-invalid':'' }}" id="image" name="image">
                        <label class="custom-file-label" for="customFile">{{__('Escoge una imagen')}}</label>
                    </div>
                    <div class="card-body">                        
                        <textarea class="form-control {{$errors->has('description') ?' is-invalid' : ''}}" id="description" name="description" rows="3">{{$post->descripcion}}</textarea>
                    </div>
                    <div class="card-body">                        
                        <label for="type">Tipo</label>
                        <select name="type" id="type" class="form-control{{ $errors->has('type') ? ' is-invalid':'' }}">                            
                            <option selected value="{{$post->tipo}}">Tu publicacion es de {{$post->tipo}}</option>
                            <option>Alquiler</option>
                            <option>Venta</option>                            
                        </select>
                    </div>

                    {{--<div class="card-body">                        
                        <label for="type">Pais</label>
                        <select name="country" id="country" class="form-control{{ $errors->has('type') ? ' is-invalid':'' }}">                            
                            <option selected value="{{$post->establishment->pais}}">Tu publicacion es de {{$post->establishment->pais}}</option>
                            <option>Perú</option>
                            <option>Chile</option>
                            <option>Bolivia</option>
                        </select>
                    </div>--}}

                    <div class="card-body">
                        <select name="city" id="city" class="form-control{{ $errors->has('city') ? ' is-invalid':'' }}">
                            <option selected value="{{$post->establishment->ciudad}}">Tu publicacion es de {{$post->establishment->ciudad}}</option>
                            <option>Arequipa</option>
                            <option>Lima</option>
                            <option>Puno</option>
                        </select>
                    </div>

                    <div class="card-body">                        
                        <input id="district" class="form-control{{ $errors->has('district') ? ' is-invalid':'' }}" type="text" name="district" value="{{$post->establishment->distrito}}" placeholder="Distrito">
                    </div>

                    <div class="card-body"> 
                        <input id="adress" class="form-control{{ $errors->has('adress') ? ' is-invalid':'' }}" type="text" name="adress" value="{{ $post->establishment->direccion}}">
                    </div>

                    <div class="card-body"> 
                        <input type="number" class="form-control{{ $errors->has('price') ? ' is-invalid':'' }}" id="price" min="0" name="price" value="{{ $post->establishment->precio}}"/>
                    </div>
                    <div class="card-body"> 
                        <select name="bathroom" id="bathroom" class="form-control{{ $errors->has('bathroom') ? ' is-invalid':'' }}">
                            @foreach($post->establishment->features as $feature)
                                <option selected value="{{$feature->baños}}">Tu publicacion es de {{$feature->baños}} baños</option>
                            @endforeach
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                        </select>
                    </div>
                    
                    <div class="card-body"> 
                        <select name="bedroom" id="bedroom" class="form-control{{ $errors->has('bedroom') ? ' is-invalid':'' }}">
                        @foreach($post->establishment->features as $feature)
                            <option selected value="{{$feature->dormitorios}}">Tu publicacion es de {{$feature->dormitorios}} dormitorios</option>
                        @endforeach
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                        </select>
                    </div>
                    <div class="card-body"> 
                        <select name="garage" id="garage" class="form-control{{ $errors->has('garage') ? ' is-invalid':'' }}">
                        @foreach($post->establishment->features as $feature)
                            <option selected value="{{$feature->garage}}">Tu publicacion {{$feature->garage}} tiene garage</option>
                        @endforeach                            
                            <option >Si</option>
                            <option >No</option>
                        </select>
                    </div>
                    <div class="card-body"> 
                        <select name="pool" id="pool" class="form-control{{ $errors->has('pool') ? ' is-invalid':'' }}">
                        @foreach($post->establishment->features as $feature)
                            <option selected value="{{$feature->pool}}">Tu publicacion {{$feature->garage}} tiene piscina</option>
                        @endforeach  
                            <option >Si</option>
                            <option >No</option>
                        </select>
                    </div>
                    
                    <div>
                        @foreach($post->establishment->features as $feature)
                            <textarea class="form-control {{$errors->has('other') ?' is-invalid' : ''}}" id="other" name="other" rows="3">{{$feature->otros}}</textarea>
                        @endforeach 
                    </div>                  

                    <input type="hidden" name="post_id" value="{{$post->id}}">
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Actualizar publicacion') }}
                            </button>
                        </div>
                    </div>
                </form>                
            </div>
        </div>
    </div>

</div>
@endsection