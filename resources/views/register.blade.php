@extends('layout')

@section('content')

    <h1>Inscrivez-vous</h1>
    <br>
    <form action="/register" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="pseudo" class="form-label" for="pseudo">Votre pseudo :</label>
            <input type="text" class="form-control @if ($errors->has('pseudo')) is-invalid @endif" name="pseudo" id="pseudo" value={{old('pseudo')}}>
            @if ($errors->has('pseudo'))
                <div class="invalid-feedback">{{ $errors->first('pseudo') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="email" class="form-label" for="email">Votre email :</label>
            <input type="email" class="form-control @if ($errors->has('email')) is-invalid @endif" name="email" id="email" value={{old('email')}}>
            @if ($errors->has('email'))
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="password" class="form-label" for="password">Votre mot de passe :</label>
            <input type="password" class="form-control @if ($errors->has('password')) is-invalid @endif" name="password" id="password">
            @if ($errors->has('password'))
                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label" for="password_confirmation">Confirmer votre mot de
                passe :</label>
            <input type="password" class="form-control @if ($errors->has('password_confirmation')) is-invalid @endif" name="password_confirmation"
                id="password_confirmation">
            @if ($errors->has('password_confirmation'))
                <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
            @endif
        </div>

        <button type="submit" id="submit" class="btn btn-primary">s'inscrire</button>
    </form>
@endsection
