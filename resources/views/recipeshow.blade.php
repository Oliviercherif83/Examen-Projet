@extends('layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="showRecipe">
                <img src='../{{ $recipe->filePictureRecipe }}'>

                <h1>{{ $recipe->nameRecipe }}</h1>
                <p>{{ $recipe->descriptionRecipe }}</p>
            </div>
        </div>
    </div>
@endsection
