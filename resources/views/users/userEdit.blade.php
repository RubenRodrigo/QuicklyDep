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
                <div class="row imagenEditar p-0 pb-4">
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
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <button type="reset" class="btn btn-secondary">Cancelar</button>
        </form>
    </div>
    <p></p>
</div>
@endsection