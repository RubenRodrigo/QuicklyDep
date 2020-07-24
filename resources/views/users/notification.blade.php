@extends('layouts.app')

@section('content')
<div class="container">

    @foreach($notifications as $notification)
    <div class="row mb-4 justify-content-md-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <p>{{App\User::find($notification->data['idUserComment'])->name}} acaba de hacer un comentario en tu <a href="{{action('PostController@show',$notification->data['idPost'])}}">publicación.</a></p>
                        <p>Comentario: {{$notification->data['data']}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection