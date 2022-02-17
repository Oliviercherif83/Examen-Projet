<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

// Gestions de mes routes avec le controller
class RouteController extends Controller
{

    // page d'accueil
    public function home()
    {
        // Vérifier si la personne est connecté
        $recipes = DB::select('SELECT * FROM `recipes` ORDER BY created_at DESC LIMIT 3');
        //var_dump(Auth::check());
        return view('home', compact('recipes'));
    }
    // liste des recettes
    public function recipe()
    {
        $recipes = DB::table('recipes')->get();
        return view('recipe', compact('recipes'));
    }

    // formulaire d'ajout de recettes
    public function formRecipe()
    {
        //retourne la vue du formulaire
        return view('addRecipe');
    }

    // formulaire d'inscription
    public function register()
    {
        return view('register');
    }
    // formulaire de connexion
    public function connect()
    {
        return view('connect');
    }

    // deconnexion de l'utilisateur
    public function disconnect(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // gestion de compte de l'utilisateur
    public function gestion()
    {
        // je vérifie si c'est bien un utilisateur inscrit , si ce n'est pas le cas , il sera rediriger vers l'accueil
        /*if (Auth::guest()) {
            return redirect('/');
        }*/
        return view('gestion_compte');
    }

    public function recipeshow($id)
    {
        // RECUPERATION DE LA TABLE RECIPE ET SELECTION DES PREMIERS ÉLÉMENTS DU TABLEAU
        $recipe = DB::table('recipes')->where('id', $id)->first();
        return view('recipeshow', compact('recipe'));
    }

    public function showForget()
    {
        return view('forgetPassword');
    }
    public function showReset($token)
    {
        return view('resetPassword', ['token' => $token]);
    }

    public function showMail()
    {
        return view('forgetPasswordMail');
    }

    public function registerAdmin()
    {
        return view('admin.registerAdmin');
    }

    public function connectAdmin()
    {
        return view('admin.connectAdmin');
    }

    public function listUsers()
    {
        // récupération de la liste des utilisateurs
        $users = DB::table('users')->get();
        return view('admin.gestionUsers', compact('users'));
    }
}
