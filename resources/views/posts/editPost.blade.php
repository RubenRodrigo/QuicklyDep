@extends('layouts.app')

@section('content')
<div class="container">
    
    {{--<nav>
        <a class="btn btn-light btn-lg" href="{{ action('PostController@userPosts') }}">Mis Publicaciones</a>
    </nav>--}}
    <div class="row justify-content-center pb-4">
        <h2>Editar publicación</h2>
    </div>
    <form class="border border-gray p-3" action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row m-0 p-0">
            <div class="form-group col-md-12 border-bottom">
                <h3>Detalles de su publicación</h3>
            </div>
            <div class="col-md-4 m-0">
            @php
                $aux = 1
            @endphp
            @forelse($post->establishment->imagen as $imagen)
            <div class="row imagenEditar p-0 pb-4">
                <img id="output{{$aux}}" src="{{ Storage::url($imagen) }}" class="card-img-top" alt="...">
                <label class="file-imagen">
                    <input name="image{{$aux}}" type="file" accept="image/*" onchange="document.getElementById('output{{$aux}}').src = window.URL.createObjectURL(this.files[0])" style="color: transparent">
                    Cambiar Foto
                </label>
            </div>            
            @php
                $aux = $aux +1                
            @endphp            
            @empty
            <div class="row imagenEditar">
                <img id="output1" class="card-img-top" alt="...">
                <label class="file-imagen">
                    <input name="image1" type="file" accept="image/*" onchange="document.getElementById('output1').src = window.URL.createObjectURL(this.files[0])" style="color: transparent">
                    Cambiar Foto
                </label>
            </div>
            <div class="row imagenEditar">
                <img id="output2" class="card-img-top" alt="...">
                <label class="file-imagen">
                    <input name="image2" type="file" accept="image/*" onchange="document.getElementById('output2').src = window.URL.createObjectURL(this.files[0])" style="color: transparent">
                    Cambiar Foto
                </label>
            </div>
            <div class="row imagenEditar">
                <img id="output3" class="card-img-top" alt="...">
                <label class="file-imagen">
                    <input name="image3" type="file" accept="image/*" onchange="document.getElementById('output3').src = window.URL.createObjectURL(this.files[0])" style="color: transparent">
                    Cambiar Foto
                </label>
            </div>
            <div class="row imagenEditar">
                <img id="output4" class="card-img-top" alt="...">
                <label class="file-imagen">
                    <input name="image4" type="file" accept="image/*" onchange="document.getElementById('output4').src = window.URL.createObjectURL(this.files[0])" style="color: transparent">
                    Cambiar Foto
                </label>
            </div>
            <div class="row imagenEditar">
                <img id="output5" class="card-img-top" alt="...">
                <label class="file-imagen">
                    <input name="image5" type="file" accept="image/*" onchange="document.getElementById('output5').src = window.URL.createObjectURL(this.files[0])" style="color: transparent">
                    Cambiar Foto
                </label>
            </div>
            @endforelse
            @php
                $nuevoAux = $aux
            @endphp 
            @for($i = 0; $i < 6-$aux;$i++)
            <div class="row imagenEditar">
                <img id="output{{$nuevoAux}}" class="card-img-top" alt="...">
                <label class="file-imagen">
                    <input name="image{{$nuevoAux}}" type="file" accept="image/*" onchange="document.getElementById('output{{$nuevoAux}}').src = window.URL.createObjectURL(this.files[0])" style="color: transparent">
                    Cambiar Foto
                </label>
            </div>
            @php
                $nuevoAux = $nuevoAux +1
            @endphp 
            @endfor
            </div>                
            <div class="col-md-6 ml-4">                
                <div class="col-md-12 pb-4">
                    <h5>
                        <label for="name">{{__('Nombre')}}</label>
                    </h5>
                    <input class="form-control{{ $errors->has('name') ? ' is-invalid':'' }}" type="text" name="name" id="name" value="{{$post->nombre}}"> 
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('name')}}</strong>
                        </span>
                    @endif  
                </div>                
                
                <div class="col-md-12 pb-4">
                    <h5>
                        <label for="description">{{__('Descripcion')}}</label>
                    </h5>                       
                    <textarea class="form-control{{$errors->has('description') ?' is-invalid' : ''}}" id="description" name="description" rows="3">{{$post->descripcion}}</textarea>
                    @if($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$errors->first('description')}}</strong>
                        </span>
                    @endif 
                </div>

                <div class="col-md-12 pb-4">                        
                    <h5>
                        <label for="price">{{__('Precio')}}</label>
                    </h5>
                    <input type="number" class="form-control" id="price" min="0" name="price" value="{{ $post->establishment->precio}}"/> 
                    @if ($errors->has('price'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('price')}}</strong>
                        </span>
                    @endif
                </div>

                {{--<div class="col-md-12 pb-4">                        
                    <label for="type">Pais</label>
                    <select name="country" id="country" class="form-control">
                        <option selected value="{{$post->establishment->pais}}">Tu publicacion es de {{$post->establishment->pais}}</option>
                        <option>Perú</option>
                        <option>Chile</option>
                        <option>Bolivia</option>
                    </select>
                </div>--}}

                <div class="col-md-12 pb-4">
                    <h5>
                        <label for="city">{{__('Ciudad')}}</label>
                    </h5>
                    <select name="city" id="city" class="form-control">
                        <option selected value="{{$post->establishment->ciudad}}">Tu publicacion es de {{$post->establishment->ciudad}}</option>
                        <option>Arequipa</option>
                        <option>Lima</option>
                        <option>Puno</option>
                    </select>
                </div>

                <div class="col-md-12 pb-4">
                    <h5>
                        <label for="district">{{__('Distrito')}}</label>
                    </h5>
                    <input id="district" class="form-control{{ $errors->has('district') ? ' is-invalid':'' }}" type="text" name="district" value="Tu publicacion es de {{$post->establishment->distrito}}" placeholder="Distrito">
                    @if ($errors->has('district'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('district')}}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-12 pb-4">
                    <h5>
                        <label for="adress">{{__('Direccion')}}</label>
                    </h5>
                    <input id="adress" class="form-control{{ $errors->has('adress') ? ' is-invalid':'' }}" type="text" name="adress" value="Tu publicacion es de {{ $post->establishment->direccion}}">
                    @if ($errors->has('adress'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('adress')}}</strong>
                        </span>
                    @endif 
                </div>

                <div class="col-md-12 pb-4">
                    <h5>
                        <label for="type">{{__('Tipo')}}</label>
                    </h5>
                    <select name="type" id="type" class="form-control">
                        <option selected value="{{$post->tipo}}">Tu publicacion es de {{$post->tipo}}</option>
                        <option>Alquiler</option>
                        <option>Venta</option>                            
                    </select>
                </div>
                <div class="col-md-12 pb-4">
                    <h5>
                        <label for="bathroom">Baños</label>
                    </h5>
                    <select name="bathroom" id="bathroom" class="form-control">
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
                
                <div class="col-md-12 pb-4"> 
                    <h5>
                        <label for="bedroom">Dormitorios</label>
                    </h5>
                    <select name="bedroom" id="bedroom" class="form-control">
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
                <div class="col-md-12 pb-4">
                    <h5>
                        <label for="garage">Garage</label>
                    </h5> 
                    <select name="garage" id="garage" class="form-control">
                    @foreach($post->establishment->features as $feature)
                        <option selected value="{{$feature->garage}}">Tu publicacion {{$feature->garage}} tiene garage</option>
                    @endforeach                            
                        <option >Si</option>
                        <option >No</option>
                    </select>
                </div>
                <div class="col-md-12 pb-4">
                    <h5>
                        <label for="pool">Piscina</label>
                    </h5> 
                    <select name="pool" id="pool" class="form-control">
                    @foreach($post->establishment->features as $feature)
                        <option selected value="{{$feature->pool}}">Tu publicacion {{$feature->garage}} tiene piscina</option>
                    @endforeach  
                        <option >Si</option>
                        <option >No</option>
                    </select>
                </div>
                
                <div class="col-md-12 pb-4">
                    <h5>
                        <label for="other">Otras Características</label>
                    </h5>
                    @foreach($post->establishment->features as $feature)
                        <textarea class="form-control{{$errors->has('other') ?' is-invalid' : ''}}" id="other" name="other" rows="3">{{$feature->otros}}</textarea>
                    @endforeach
                    @if ($errors->has('other'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('other')}}</strong>
                        </span>
                    @endif  
                </div>                  

                <input type="hidden" name="post_id" value="{{$post->id}}">                
            </div>
            <div class="col-md-12 row justify-content-center">                
                <button type="submit" class="btn btn-dark btn-lg">
                    {{ __('Actualizar publicacion') }}
                </button>                                    
            </div>
        </div>
    </form>
</div>
@endsection