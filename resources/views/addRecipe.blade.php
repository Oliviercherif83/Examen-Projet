@extends('layout')

@section('content')
    <h1>Veuillez ajouter votre recette ci-dessous :</h1>
    <form method="POST" action='/addRecipe' enctype="multipart/form-data">
        <!-- le csrf permet de générer un token et vérifier si la session en cours correspond bien au formulaire saisi-->
        @csrf
        <div class="mb-3">
            <label class="form-label" for="filePictureRecipe">Choisir une image...</label>
            <input class="form-control @if($errors->has('filePictureRecipe')) is-invalid @endif" type="file" id="filePictureRecipe" value="{{ old ('filePictureRecipe')}}" name="filePictureRecipe"
                accept="image/png, image/jpeg">
            <!--je génère ma première erreur lorsque je n'ajoute aucune image-->
            @if ($errors->has('filePictureRecipe'))
                <div class="invalid-feedback">{{ $errors->first('filePictureRecipe') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="nameRecipe" class="form-label">Nom de la recette :</label>
            <input type="text" name="nameRecipe" class="form-control @if($errors->has('nameRecipe')) is-invalid @endif " id="nameRecipe">
            @if ($errors->has('nameRecipe'))
                <div class="invalid-feedback">{{ $errors->first('nameRecipe') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="descriptionRecipe" class="form-label">Description de la recette :</label>
            <textarea type="text" name="descriptionRecipe" class="form-control @if($errors->has('descriptionRecipe')) is-invalid @endif" id="descriptionRecipe"></textarea>
            @if ($errors->has('descriptionRecipe'))
                <div class="invalid-feedback">{{ $errors->first('descriptionRecipe') }}</div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Ajoutez</button>
    </form>

@endsection
