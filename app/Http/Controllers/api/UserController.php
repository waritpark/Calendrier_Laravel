<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // voir le token
        // return $this->respondWithToken($token);
        return response()->json(['message' => 'Vous êtes connecté', 'token'=>$token, 'code' => 200]);

    }

    public function eventByDay()
    {
        // utilisateur actuellement authentifié
        $user = auth('api')->user();

        // test pour recuperer l'id de l'utilisateur
        // return response()->json($user['id']);

        $events = DB::table('events')
        ->where('user_id', "=", $user['id'])
        ->whereBetween('start', [date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59')])
        ->get();
        return response()->json($events);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Déconnexion effectué']);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

}
