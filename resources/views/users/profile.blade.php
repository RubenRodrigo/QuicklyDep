@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <img src="{{ Storage::url( $user->avatar) }}" style="width:150px; height:150px; float:left; border-radius:50% margin-right:25px;">
            <h2>Perfil de {{ $user->name }}</h2>
            <form enctype="multipart/form-data" action="{{ route('update.profile', $user->id ) }}" method="POST">
                <label>actualizar la imagen de Perfil</label>
                <br>
                <input type="file" name="avatar">
                <br>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <br>
                <input type="submit" class="pull-right btn btn-sm btn-primary">
            </form>
        </div>
    </div>
</div>
@endsection