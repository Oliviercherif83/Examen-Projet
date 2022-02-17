<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormAdminController;
use App\Http\Controllers\FormUserController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RouteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Routes accessibles pour le public 
Route::get('/', [RouteController::class, 'home']);
Route::get('/recipe-list', [RouteController::class, 'recipe']);
Route::get('/recipe-list/{id}', [RouteController::class, 'recipeshow']);
Route::get('/register', [RouteController::class, 'register']);
Route::get('/connect', [RouteController::class, 'connect']);
Route::get('/disconnect', [RouteController::class, 'disconnect']);

// Récupére les requêtes de mes formulaires d'inscription et connexion
Route::post('/register', [FormUserController::class, 'store']);
Route::post('/connect', [FormUserController::class, 'authenticate']);

// Route::group : permet d'éviter la répétition du middleware
// middleware redirect qui permet aux internautes de ne pas accéder aux urls réservé seulement aux admnistrateurs et utilisateurs
Route::group(['middleware' => 'redirect'], function () {
    Route::get('/addRecipe', [RouteController::class, 'formRecipe']);
    Route::post('/addRecipe', [RecipeController::class, 'store']);
    Route::get('/gestion_compte', [RouteController::class, 'gestion']);
    Route::post('/change-pseudo', [FormUserController::class, 'changePseudo']);
    Route::post('/changePassword', [FormUserController::class, 'changePassword']);
});

// middleware guest redirige à la page d'accueil si l'utilisateur est authentifier
Route::group(['middleware' => 'guest'], function () {
    Route::get('/forgetPassword', [RouteController::class, 'showForget']);
    Route::post('/forgetPassword', [FormUserController::class, 'forgetControl']);
    Route::get('/resetPassword/{token}', [RouteController::class, 'showReset'])->name('reset.password.get');
    Route::post('/resetPassword', [FormUserController::class, 'resetControl']);
    Route::get('/forgetPasswordMail', [RouteController::class, 'showMail']);
});

Route::get('/register/admin', [RouteController::class, 'registerAdmin']);
Route::get('/connect/admin', [RouteController::class, 'connectAdmin']);
Route::post('/register/admin', [FormAdminController::class, 'storeAdmin']);
Route::post('/connect/admin', [FormAdminController::class, 'authenticateAdmin']);

// Route réservé uniquement à l'administrateur
Route::group(['middleware' => 'reserved'], function () {
    Route::get('/listUsers', [RouteController::class, 'listUsers']);
    Route::get('/listUsers/{id}', [AdminController::class, 'destroyUser']);
    Route::get('/recipeList/{id}', [AdminController::class, 'destroyRecipe']);
});