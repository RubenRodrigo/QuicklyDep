@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>Editar usuario {{$user->name}}</h2>
        </div>
        <div class="row justify-content-center">
            @if (count($errors) > 0)
            <div class="row justify-content-center">
            <p>Hubo problemas con los datos proporcionados</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('users.update', $user->id ) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" value="{{$user->name}}" placeholder="Escribe tu nombre">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="Escribe tu email">
            </div>
            <div class="form-group">
                <label for="image">Imagen de perfil</label>
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
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <button type="reset" class="btn btn-secondary">Cancelar</button>
        </form>
    </div>
    <p></p>
</div>
@endsection