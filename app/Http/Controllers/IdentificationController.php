<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IdentificationController extends Controller
{
    public function connexion()
    {
        return view('connexion');
    }

    public function connexionPost(Request $request)
    {
        $request->validate([
            'email' => 'required|max:100|email',
            'password' => 'required|max:100|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        if ($request->filled('email') && $request->filled('password')) {
            if (Auth::attempt($credentials)) {
                $userId = Auth::user()->id;
                $request->session()->put('id_user', $userId);
                return redirect()->route('accueil.dashboard');
                // dd($request); dd = dump and die
            }
            return redirect()->route("connexion")
            ->with('error', 'Email ou mot de passe incorrect');
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
            'password' => 'required|max:100|min:6',
            'password2' => 'required|max:100|min:6'
        ]);
        $user = new User();
        $email = $request->input('email');
        $name = $request->input('name');
        $prenom = $request->input('prenom');
        $password = $request->input('password');
        $password2 = $request->input('password2');
        $role_user = 2;
        // condition isset et empty
        if ($request->filled('email') && $request->filled('name') && $request->filled('prenom')
        && $request->filled('password')
        && $request->filled('password2')) {
            // condition v??rifier si mail existe deja ou non
            if (User::where('email', '=', $email)->exists()) {
                return redirect()->back()->with('error', "l'adresse mail est deja utilis??e !");
            }
            else {
                // condition de l'??galit?? des mdp
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
                    return redirect()->back()
                    ->with('error', 'les mots de passe doivent ??tre identique !');
                }
            }
        }
        // le else est en commentaire car il y a deja un retour si les champs ne sont pas correctement remplis, cela ferait 2 erreurs affich??s pour la meme erreur
        // else {
        //     return redirect()->back()->with('error', 'Tous les champs doivent ??tre remplis !');
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
        if($request->filled('email') && $request->filled('name')
        && $request->filled('prenom')
        && $request->filled('role_user')) {
            $user->save();
            return redirect()->route('stats.users.dashboard')
            ->with('update_user', 'modification ??ffectu?? !');
        }
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
                return redirect()->route('accueil.dashboard')->with('update_compte', 'modification ??ffectu??e !');
            }
            // condition avec les mdp
            elseif ($request->filled('password') && $request->filled('password2') && $password===$password2) {
                $request->validate([
                    'password' => 'required|max:100|min:6',
                    'password2' => 'required|max:100|min:6'
                ]);
                $user->password = Hash::make($password);
                $user->save();
                return redirect()->route('accueil.dashboard')->with('update_compte', 'modification ??ffectu??e !');
            }
            // les autres possibilites
            else {
                return redirect()->back()->with('error', 'modification ??chou??e !');
            }
        }
        // le else est en commentaire car il y a deja un retour si les champs ne sont pas correctement remplis, cela ferait 2 erreurs affich??s pour la meme erreur
        // else {
        //     return redirect()->back()->with('error', 'Tous les champs doivent ??tre remplis !');
        // }
    }

    public function destroyUser($id)
    {
        $user=User::find($id);
        $events = DB::table('events')
        ->where('user_id', "=", $id)
        ->delete();
        $user->delete();
        return redirect()->back()
        ->with("destroy_user",
        "l'utilisateur et ses ??venements
        ont bien ??t?? supprim??");
    }

    public function deconnexion()
    {
        return redirect()->route('accueil');
    }
}
