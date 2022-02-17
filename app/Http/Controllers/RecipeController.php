<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    //controller qui va gérer la sécurité du formulaire d'ajout de recettes
    public function store(Request $request)
    {
        if ($request->hasFile('filePictureRecipe')) {
            $image = $request->file('filePictureRecipe');
            $image_name = $image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $image_name);
            // récupère la requête de la BDD
            $recette = Recipe::create([
                'filePictureRecipe' => 'images/' . $image_name,
                'nameRecipe' => request('nameRecipe'),
                'descriptionRecipe' => request('descriptionRecipe'),
                'user_id' => auth()->id()
            ]);
            $recette->save();
            //return "Nous avons bien reçu votre recette qui est " . request('nameRecipe');
            return redirect('/')->with('message', "la recette " . request('nameRecipe') . ' a bien été ajoutée !');

            // contrôle l'ajout de la recette du formulaire
            //return "Nous avons bien reçu votre recette qui est " . request('nameRecipe');

        } else {
            //return ("Votre image n'a pas été ajouté, veuillez réessayer...");
            return request()->validate([
                'filePictureRecipe' => 'required|image',
                'nameRecipe' => 'required',
                'descriptionRecipe' => 'required',
            ]);
        }
    }
}
