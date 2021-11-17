<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\MonthController;

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
        return redirect()->route("connexion")->with('error', 'Email ou mot de passe incorrect');
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
        $password2 = $request->input('password2');
        $role_user = 2;
        if ($password == $password2) {
            $user->email = $email;
            $user->name = $name;
            $user->prenom = $prenom;
            $user->password = Hash::make($password);
            $user->role_user = $role_user;
            $user->save();
            return redirect()->route('connexion');
        }
        else {
            return redirect()->route('inscription')->with('error', 'les mots de passe doivent être identique !');
        }
    }

    public function stats()
    {
        $users = DB::table('users')
        ->orderBy('id')
        ->get();
        return view('stats', ['users'=>$users]);
    }

    public function edit($id) 
    {
        $user = User::find($id);
        return view('update-user', ['user'=>$user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->prenom = $request->input('prenom');
        $user->role_user = $request->input('role_user');
        $user->save();
        return redirect()->route('stats.users.dashboard')->with('update_user', 'modification éffectué !');
    }

    public function viewCompte()
    {
        return view('update-compte');
    }

    public function updateCompte(Request $request)
    {
        $id = $request->session()->get('id_user');
        $user = User::find($id);
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->prenom = $request->input('prenom');

        if ($request->missing('password')) {
            $user->save();
            return redirect()->route('accueil.dashboard')->with('update_compte', 'modification éffectué !');
        } else {
            $password = $request->input('password');
            $user->password = Hash::make($password);
            $user->save();
            return redirect()->route('accueil.dashboard')->with('update_compte', 'modification éffectué !');
        }

    }

    public function destroyUser($id) 
    {
        $user=User::find($id);
        $user->delete();
        return redirect()->back()->with("destroy_user", "l'utilisateur à bien été supprimé");
    }

    public function deconnexion()
    {
        return redirect()->route('accueil');
    }
}