@extends('layout')
@section('content')
    <h1>Liste des recettes</h1>
    @if (session('messageSupprRecipe'))
        <div class="alert alert-success">{{ session('messageSupprRecipe') }}</div>
    @endif
    <br>
    <div class="row">

        @foreach ($recipes as $recipe)
            <div class="col-lg-3 col-md-6 col-12 listRecipe">
                <div class="imgRecipe">
                    <img src={{ $recipe->filePictureRecipe }}>
                </div>
                <h2>{{ $recipe->nameRecipe }}</h2>
                <!--j'ajoute une limite de caractère pour la description de mon paragraphe-->
                <p>{{ \Illuminate\Support\Str::limit($recipe->descriptionRecipe, 40, $end = '...') }}</p>
                <a class="btn btn-primary" href="/recipe-list/{{ $recipe->id }}">Voir la recette</a>
                @if(Auth::guard('admin')->check())
                    <a class="btn buttonDelete" href={{ url('/recipeList',$recipe->id) }}>Supprimer</a>
                @endif
            </div>
        @endforeach
        <!--<div id="app">
            <my-component />
        </div>-->
    </div>
@endsection
