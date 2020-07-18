@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center py-4">
            <h2>Haz tu nueva publicación</h2>
        </div>
        <div class="row justify-content-center">
            @if (count($errors)>0)
                <div class="row alert alert-danger">
                    <p>¡Opss! Hubo problemas con los datos proporcionados</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-10 offset-md-1">
            <form class="form-row border border-gray p-3" action="{{action('PostController@store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group col-md-12 border-bottom">
                    <h3>Detalles de su publicación</h3>
                </div>
                <div class="form-group col-md-8 mt-3">                                        
                    <h5>
                        <label for="description">{{__('Nombre')}}</label>
                    </h5>                    
                    <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid':'' }}" type="text" name="name" value="{{ old('name') }}" autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('name')}}</strong>
                        </span>
                    @endif                    
                </div>

                <div class="form-group col-md-8 mt-3">                    
                    <h5>
                        <label for="description">{{__('Descripcion')}}</label>
                    </h5>
                    <textarea class="form-control {{$errors->has('description') ?' is-invalid' : ''}}" id="description" name="description" rows="3">{{old('description')}}</textarea>
                    @if($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$errors->first('description')}}</strong>
                        </span>
                    @endif                    
                </div>

                <div class="form-group col-md-8 mt-3">
                    <h5>
                        <label for="price">{{__('Precio')}}</label>
                    </h5>                    
                    <input type="number" class="form-control{{ $errors->has('price') ? ' is-invalid':'' }}" id="price" min="0" name="price"/>

                    @if ($errors->has('price'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('price')}}</strong>
                        </span>
                    @endif                        
                </div>

                <div class="form-group col-md-8 mt-3">
                    <h5>
                        <label for="city">{{__('Direccion')}}</label>
                    </h5>
                    <select name="city" id="city" class="form-control{{ $errors->has('city') ? ' is-invalid':'' }}">
                        <option selected value="x">Escoge la ciudad</option>
                        <option>Arequipa</option>
                        <option>Lima</option>
                        <option>Puno</option>
                    </select>
                    @if ($errors->has('city'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('city')}}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-8 mt-3">
                    <h5>
                        <label for="district">{{__('Distrito')}}</label>
                    </h5>
                    <input id="district" class="form-control{{ $errors->has('district') ? ' is-invalid':'' }}" type="text" name="district" value="{{ old('district') }}" autofocus placeholder="Distrito">
                    @if ($errors->has('district'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('district')}}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-8 mt-3">
                    <h5>
                        <label for="adress">{{__('Direccion')}}</label>
                    </h5>
                    <input id="adress" class="form-control{{ $errors->has('adress') ? ' is-invalid':'' }}" type="text" name="adress" value="{{ old('adress') }}" autofocus placeholder="Direccion">
                    @if ($errors->has('adress'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('adress')}}</strong>
                        </span>
                    @endif                    
                </div>

                <div class="form-group col-md-8 mt-3"> 
                    <h5>
                        <label for="type">{{__('Tipo')}}</label>
                    </h5>                                        
                    <select name="type" id="type" class="form-control{{ $errors->has('type') ? ' is-invalid':'' }}">
                        <option selected value="x">Escoge el tipo...</option>
                        <option >Venta</option>
                        <option >Alquiler</option>
                    </select>
                    @if ($errors->has('type'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('type')}}</strong>
                        </span>
                    @endif                    
                </div>

                <div class="form-group col-md-8 mt-3">
                    <h5>
                        <label for="bathroom">Baños</label>
                    </h5> 
                    <select name="bathroom" id="bathroom" class="form-control{{ $errors->has('bathroom') ? ' is-invalid':'' }}">
                        <option selected value="x">Número de Baños</option>
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
                    @if ($errors->has('bathroom'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('bathroom')}}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-8 mt-3">
                    <h5>
                        <label for="bedroom">Dormitorios</label>
                    </h5>
                    <select name="bedroom" id="bedroom" class="form-control{{ $errors->has('bedroom') ? ' is-invalid':'' }}">
                        <option selected value="x">Número de dormitorios</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                    </select>
                    @if ($errors->has('bedroom'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('bedroom')}}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-8 mt-3">
                    <h5>
                        <label for="garage">Garage</label>
                    </h5>
                    <select name="garage" id="garage" class="form-control{{ $errors->has('garage') ? ' is-invalid':'' }}">
                        <option selected value="x">Garage</option>
                        <option >Si</option>
                        <option >No</option>
                    </select>
                    @if ($errors->has('garage'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('garage')}}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-8 mt-3">
                    <h5>
                        <label for="pool">Piscina</label>
                    </h5>
                    <select name="pool" id="pool" class="form-control{{ $errors->has('pool') ? ' is-invalid':'' }}">
                        <option selected value="x">Piscina</option>
                        <option >Si</option>
                        <option >No</option>
                    </select>
                    @if ($errors->has('pool'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('pool')}}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-8 mt-3">
                    <h5>
                        <label for="other">Otras Características</label>
                    </h5>                    
                    <textarea class="form-control {{$errors->has('other') ?' is-invalid' : ''}}" id="other" name="other" rows="3">{{old('other')}}</textarea>

                    @if ($errors->has('other'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('other')}}</strong>
                        </span>
                    @endif                    
                </div>

                <div class="form-group col-md-8"> 
                    <h5>
                        Escoja sus imagenes favoritas
                    </h5>                   
                    <div class="custom-file">
                        <input type="file" class="custom-file-input{{ $errors->has('image') ? ' is-invalid':'' }}" id="image" name="image[]" multiple>
                        <label class="custom-file-label" for="customFile">{{__('Escoge una imagen')}}</label>

                        @if ($errors->has('image'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('image')}}</strong>
                            </span>
                        @endif
                    </div>                    
                </div>

                <div class="form-group col-md-8">                    
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create') }}
                    </button>
                </div>                
            </form>
            </div>
        </div>
    </div>
@endsection