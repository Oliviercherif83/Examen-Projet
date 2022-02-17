@extends('layout')

@section('content')
<!--bcrypt-->
    <h1>Connectez-vous en tant qu'administrateur</h1>
    @if (Session::has('messageAdmin'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('messageAdmin') }}
        </div>
    @endif
    <form method="POST" action="/connect/admin">
        @csrf
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
            <input type="checkbox" class="custom-control-input" name="remember" id="remember">
            <label class="custom-control-label" for="remember">Se souvenir de moi</label>
        </div>
        <a href="/forgetPassword">mot de passe oublié ?</a><br>
        <button type="submit" id="submit" class="btn btn-primary">Se connecter</button>
    </form>
@endsection
