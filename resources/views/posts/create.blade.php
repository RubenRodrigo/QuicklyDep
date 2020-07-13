@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>Nueva Publicacion</h2>
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
            <form action="{{action('PostController@store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="col-sm-2 col-form-label" for="name">{{__('Nombre')}}</label>
                    <div class="col-sm-12">
                        <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid':'' }}" type="text" name="name" value="{{ old('name') }}" autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('name')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-form-label" for="description">{{__('Descripcion')}}</label>
                    <div class="col-sm-12">
                        <textarea class="form-control {{$errors->has('description') ?' is-invalid' : ''}}" id="description" name="description" rows="3">{{old('description')}}</textarea>
                        @if($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$errors->first('description')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input{{ $errors->has('image') ? ' is-invalid':'' }}" id="image" name="image">
                            <label class="custom-file-label" for="customFile">{{__('Escoge una imagen')}}</label>

                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-form-label" for="price">{{__('Precio')}}</label>
                    <div class="col-sm-12">                    
                        <div class="custom-file">                           
                            <input type="number" class="form-control{{ $errors->has('price') ? ' is-invalid':'' }}" id="price" min="0" name="price"/>

                            @if ($errors->has('price'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('price')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-form-label" for="adress">{{__('Direccion')}}</label>
                    <div class="col-sm-12">
                        <select name="country" id="country" class="form-control{{ $errors->has('country') ? ' is-invalid':'' }}">
                            <option selected value="x">Escoge el pais</option>
                            <option>Perú</option>
                            <option>Chile</option>
                        </select>
                        @if ($errors->has('country'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('country')}}</strong>
                            </span>
                        @endif

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

                        <input id="district" class="form-control{{ $errors->has('district') ? ' is-invalid':'' }}" type="text" name="district" value="{{ old('district') }}" autofocus placeholder="Distrito">

                        <input id="adress" class="form-control{{ $errors->has('adress') ? ' is-invalid':'' }}" type="text" name="adress" value="{{ old('adress') }}" autofocus placeholder="Direccion">
                        @if ($errors->has('adress'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('adress')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group"> 
                    <div class="col-sm-12">                   
                        <label for="type">Tipo</label>
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
                </div>

                <div class="form-group"> 
                    <div class="col-sm-12">                   
                        <label for="type">Características</label>

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

                        <label for="type">Otras Características</label>
                        <textarea class="form-control {{$errors->has('other') ?' is-invalid' : ''}}" id="other" name="other" rows="3">{{old('other')}}</textarea>

                        @if ($errors->has('other'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('other')}}</strong>
                            </span>
                        @endif
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
        </div>
    </div>
@endsection