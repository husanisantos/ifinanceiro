<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;

class AuthController extends BaseController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'check']]);
    }

    /**
     * Login
     *
     * @return void
     */
    public function login()
    {
        $credentials = request(['username', 'password']);
        if (! $token = auth()->attempt($credentials)) {
            return response()->json([
                'error' => 'Credenciais inválidas, acesso ao sistema não permitido.'
            ], 401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * Chgeck
     *
     * @return json
     */
    public function check() {

        if(auth()->check()) {
            return response()->json([
                auth()->user()
            ], 200);
        }

        return response()->json( false, 401);
    }

    /**
     * refresh
     *
     * @return void
     */
    public function refresh()
    {
        $token = auth()->refresh();
        return $this->respondWithToken($token);
    }

    /**
     * Logout
     *
     * @return void
     */
    public function logout()
    {
        auth()->logout();
        return response()->json([
            'message' => 'Logout with success!'
        ], 401);
    }

    /**
     * Undocumented function
     *
     * @param [type] $token
     * @return void
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60 // default 1 hour
        ]);
    }
}