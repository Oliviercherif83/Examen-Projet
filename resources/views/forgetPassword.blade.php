@extends('layout')

@section('content')
    <h1>Pour la récupération de votre mot de passe, veuillez entrer votre e-mail ci-dessous : </h1>
    <br>
    @if (session('messageEmail'))
        <div class="alert alert-success">{{ session('messageEmail') }}</div>
    @endif
    <form action="forgetPassword" method="POST">
        @csrf
        <div class="form-group row">
            <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
            <div class="col-md-6">
                <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                Envoyer le lien de réinitialisation du mot de passe
            </button>
        </div>
    </form>
@endsection
