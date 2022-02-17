@extends('layout')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h1>Paramètres du compte</h1>
    <br>
    <div class="card">
        <div class="card-header">Mon profil</div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h2>Modification du pseudo:</h2>
                    <form action="/change-pseudo" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="pseudo" class="form-label">Nouveau pseudo</label>
                            <input type="text" class="form-control @if ($errors->has('pseudo')) is-invalid @endif"
                                name="pseudo">
                            @if ($errors->has('pseudo'))
                                <div class="invalid-feedback">{{ $errors->first('pseudo') }}</div>
                            @endif
                        </div>
                        <button type="submit" id="submit" class="btn btn-primary">Modifier mon pseudo</button>
                    </form>
                </div>
                <div class="col-6">
                    <h2>Modification du mot de passe :</h2>
                    <form action="/changePassword" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="password">Nouveau mot de passe :</label>
                            <input type="password" name="password"
                                class="form-control @if ($errors->has('password')) is-invalid @endif">
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation">Confirmer le nouveau mot de passe :</label>
                            <input type="password" name="password_confirmation"
                                class="form-control @if ($errors->has('password_confirmation')) is-invalid @endif">
                            @if ($errors->has('password_confirmation'))
                                <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                            @endif
                        </div>
                        <button type="submit" id="submit" class="btn btn-primary">Modifier mon mot de passe</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
