<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    protected function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/listUsers')->with('messageSuppr', "L'utilisateur a été supprimé.");
    }
    protected function destroyRecipe($id){
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();
        return redirect('/recipe-list')->with('messageSupprRecipe', "La recette a été supprimée.");
    }

}
