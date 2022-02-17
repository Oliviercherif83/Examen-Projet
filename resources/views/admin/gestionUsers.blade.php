@extends('layout')

@section('content')


    <h1>Liste des utilisateurs</h1>
    @if (session('messageSuppr'))
        <div class="alert alert-success">{{ session('messageSuppr') }}</div>
    @endif
    <br>
    <div class="row">
        @foreach ($users as $user)
            <div class="col-lg-3 col-md-6 col-12 ">
                <div class="flex">
                    <h2>Utilisateurs n°{{ $user->id }}</h2>
                    <a class="buttonDelete" href={{ url('/listUsers',$user->id) }}>X</a>
                </div>
                <p><strong>pseudo : </strong>{{ $user->pseudo }}</p>
                <p><strong>email : </strong>{{ $user->email }}</p>
            </div>
        @endforeach
    </div>
@endsection
