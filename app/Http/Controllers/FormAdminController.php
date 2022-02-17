<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Password;

class FormAdminController extends Controller
{
    public function storeAdmin()
    {
        // on donne des conditions aux champs
        request()->validate([
            'pseudo' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8|max:30|string',
        ]);
        // request = permet de récupérer les champs de nos formulaire et les stocker dans la base de données correspondante 
        $admin = Admin::create([
            'pseudo' => request('pseudo'),
            'email' => request('email'),
            // on utilise Hash pour crypter le mot de passe
            'password' => Hash::make(request('password')),
        ]);
        $admin->save();

        return redirect('/connect/admin')->with('messageAdmin', 'vous avez bien été inscrit');
    }
    
    public function authenticateAdmin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        Admin::where('email', $request->email)->first();

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => "Email incorrect ou l'administrateur n'existe pas",
        ]);
    }

}
