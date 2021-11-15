<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\MonthController;
use GuzzleHttp\Middleware;
use App\Http\Controllers\Controller;

class IdentificationController extends Controller
{
    public function connexion()
    {
        return view('connexion');
    }

    public function connexionPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $userId = Auth::user()->id;
            $request->session()->put('id_user', $userId);
            return redirect()->route('accueil.dashboard');
            // dd($request);

        }
  
        return redirect("connexion");

    }

    public function inscription()
    {
        return view('inscription');
    }

    public function inscriptionPost(Request $request)
    {
        //dd($request);
        $validatedData = $request->validate([
            'email' => 'required|max:100',
            'name' => 'required|max:100',
            'prenom' => 'required|max:100',
            'password' => 'required|max:100|min:6'
        ]);
        $user = new User();
        $email = $request->input('email');
        $name = $request->input('name');
        $prenom = $request->input('prenom');
        $password = $request->input('password');
        $role = 2;

        $user->email = $email;
        $user->name = $name;
        $user->prenom = $prenom;
        $user->password = Hash::make($password);
        $user->role = $role;
        $user->save();
        return redirect()->route('connexion');
    }

    public function deconnexion()
    {
        return redirect()->route('accueil');
    }
}