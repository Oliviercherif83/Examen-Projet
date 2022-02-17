<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Password;

class FormUserController extends Controller
{
    public function store()
    {
        // on donne des conditions aux champs
        request()->validate([
            'pseudo' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8|max:30|string',
        ]);
        // request = permet de récupérer les champs de nos formulaire et les stocker dans la base de données correspondante 
        $user = User::create([
            'pseudo' => request('pseudo'),
            'email' => request('email'),
            // on utilise Hash pour crypter le mot de passe
            'password' => Hash::make(request('password')),
        ]);
        $user->save();

        return redirect('/')->with('message', "Votre inscription s'est déroulée avec succés !");
    }

    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        //$request-> remember me générera un token qui permettra à mon utilisateur de rester connecter
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => "Email incorrect ou l'utilisateur n'existe pas",
        ]);
    }

    function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|string'
        ]);

        $modif_pass = Auth::user();


        $modif_pass->update([
            'password' => Hash::make(request('password'))
        ]);
        return redirect('gestion_compte')->with('success', 'Votre mot de passe à bien été changé');

        /*$modif_pass->save();

        */
        var_dump(Auth::user());
    }

    function changePseudo(Request $request)
    {
        $request->validate([
            'pseudo' => 'required|string',
        ]);

        $modif_pseudo = Auth::user();

        $modif_pseudo->update([
            'pseudo' => $request->pseudo
        ]);
        return redirect('gestion_compte')->with('success', 'Votre pseudo à été modifié');
    }

    function forgetControl(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('forgetPasswordMail', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
            return redirect('/forgetPassword')->with('messageEmail', 'Nous avons envoyé votre lien de réinitialisation de mot de passe par e-mail !');
        });
    }

    function resetControl(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();
        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }
        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);


        DB::table('password_resets')->where(['email' => $request->email])->delete();
        return redirect('/connect')->with('messagePassword', 'Votre mot de passe a été changé!');
    }
}
