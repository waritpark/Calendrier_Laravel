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
        if ($request->filled('email') && $request->filled('password')) {
            if (Auth::attempt($credentials)) {
                $userId = Auth::user()->id;
                $request->session()->put('id_user', $userId);
                return redirect()->route('accueil.dashboard');
                // dd($request); dd = dump and die
            }
            return redirect()->route("connexion")->with('error', 'Email ou mot de passe incorrect');
        }
    }

    public function inscription()
    {
        return view('inscription');
    }

    public function inscriptionPost(Request $request)
    {
        //dd($request);
        $request->validate([
            'email' => 'required|max:100|email',
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
        // condition isset et empty
        if ($request->filled('email') && $request->filled('name') && $request->filled('prenom') && $request->filled('password') && $request->filled('password2')) {
            // condition de l'égalité des mdp
            if ($password === $password2) {
                $user->email = $email;
                $user->name = $name;
                $user->prenom = $prenom;
                $user->password = Hash::make($password);
                $user->role_user = $role_user;
                $user->save();
                return redirect()->route('connexion');
            }
            else {
                return redirect()->back()->with('error', 'les mots de passe doivent être identique !');
            }
        }
        // le else est en commentaire car il y a deja un retour si les champs ne sont pas correctement remplis, cela ferait 2 erreurs affichés pour la meme erreur
        // else {
        //     return redirect()->back()->with('error', 'Tous les champs doivent être remplis !');
        // }
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
        $request->validate([
            'email' => 'required|max:100|email',
            'name' => 'required|max:100',
            'prenom' => 'required|max:100',
            'role_user' => 'required|max:1'
        ]);
        $user = User::find($id);
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->prenom = $request->input('prenom');
        $user->role_user = $request->input('role_user');
        // condition isset et empty
        if($request->filled('email') && $request->filled('name') && $request->filled('prenom') && $request->filled('role_user')) {
            $user->save();
            return redirect()->route('stats.users.dashboard')->with('update_user', 'modification éffectué !');
        }
        // le else est en commentaire car il y a deja un retour si les champs ne sont pas correctement remplis, cela ferait 2 erreurs affichés pour la meme erreur
        // else {
        //     return redirect()->back()->with('error', 'Tous les champs doivent être remplis !');
        // }
    }

    public function viewCompte()
    {
        return view('update-compte');
    }

    public function updateCompte(Request $request)
    {
        $request->validate([
            'email' => 'required|max:100|email',
            'name' => 'required|max:100',
            'prenom' => 'required|max:100',
        ]);
        $id = $request->session()->get('id_user');
        $user = User::find($id);
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->prenom = $request->input('prenom');
        $password = $request->input('password');
        $password2 = $request->input('password2');
        // condition isset et empty
        if($request->filled('email') && $request->filled('name') && $request->filled('prenom')) {
            // condition sans les mdp
            if ($request->missing('password') || $request->missing('password2')) {
                $user->save();
                return redirect()->route('accueil.dashboard')->with('update_compte', 'modification éffectuée !');
            } 
            // condition avec les mdp
            elseif ($request->filled('password') && $request->filled('password2') && $password===$password2) {
                $request->validate([
                    'password' => 'required|max:100|min:6',
                    'password2' => 'required|max:100|min:6'
                ]);
                $user->password = Hash::make($password);
                $user->save();
                return redirect()->route('accueil.dashboard')->with('update_compte', 'modification éffectuée !');
            }
            // les autres possibilites
            else {
                return redirect()->back()->with('error', 'modification échouée !');
            }
        }
        // le else est en commentaire car il y a deja un retour si les champs ne sont pas correctement remplis, cela ferait 2 erreurs affichés pour la meme erreur
        // else {
        //     return redirect()->back()->with('error', 'Tous les champs doivent être remplis !');
        // }
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