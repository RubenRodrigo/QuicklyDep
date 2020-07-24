@extends('layouts.app')

@section('content')
    <div class="container md-auto">
        <div class="row justify-content-center">
            <h2>Editar usuario {{$user->name}}</h2>
        </div>
        @if (count($errors) > 0)
        <div class="row justify-content-center">            
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
            <div class="row p-0 m-0">
                <div class="col-md-4 offset-md-4 p-0">
                    <div class="row p-0 pt-3">
                        <div class="col-md-12 p-0">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}" placeholder="Escribe tu nombre">
                        </div>
                    </div>
                    <div class="row p-0 pt-3">
                        <div class="col-md-12 p-0">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="Escribe tu email">
                        </div>
                    </div>
                    <div class="row p-0 pt-3">
                        <div class="col-md-12 imagenPerfil p-0 pb-4">
                            @isset(Auth::user()->img_profile)
                            <img id="output" src="{{ Storage::url(Auth::user()->img_profile) }}" class="card-img-top" alt="...">
                            @else
                            <img id="output" src="https://static.vecteezy.com/system/resources/previews/000/550/731/non_2x/user-icon-vector.jpg" class="card-img-top" alt="...">
                            @endisset
                            <label class="file-imagen">
                                <input name="image" type="file" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" style="color: transparent">
                                Añadir Foto
                            </label>
                        </div>
                    </div>
                    <div class="row justify-content-between p-0">
                        <div class="col-md-3 m-0 p-0">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                        <div class="col-md-3 m-0 p-0">
                            <button type="reset" class="btn btn-secondary">Cancelar</button>
                        </div>                        
                    </div>
                </div>
            </div>
        </form>
    </div>
    <p></p>
</div>
@endsection