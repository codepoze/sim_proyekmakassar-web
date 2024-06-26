<?php

namespace App\Http\Controllers\api;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
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
        $credentials = request(['username', 'password']);

        // untuk check users
        $checking = [
            'username' => $credentials['username'],
            'password' => $credentials['password'],
            'active'   => 'y'
        ];

        if ($token = Auth::attempt($checking)) {
            // untuk data users
            $users = User::with(['toRole:id_role,nama,role'])->find(Auth::id());

            // untuk check role
            $check = Role::whereRole($users->toRole->role)->first();
            if ($check !== null) {
                if ($check->role === 'kord_teknislap') {
                    $data = [
                        'id'       => $users->id,
                        'id_users' => $users->id_users,
                        'token'    => $this->respondWithToken($token)->original
                    ];

                    return response([
                        "status" => true,
                        "data"   => $data
                    ], Response::HTTP_OK);
                } else {
                    return response(
                        ['status' => false, 'title' => 'Gagal!', 'text' => 'Username atau Password Anda salah!', 'type' => 'error', 'button' => 'Ok!'],
                        Response::HTTP_OK
                    );
                }
            }
        } else {
            return response(
                ['status' => false, 'title' => 'Gagal!', 'text' => 'Username atau Password Anda salah!', 'type' => 'error', 'button' => 'Ok!'],
                Response::HTTP_OK
            );
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $token = JWTAuth::getToken();
        return $this->respondWithToken(JWTAuth::refresh($token));
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
            'expires_in' => JWTAuth::factory()->getTTL() * 24 * 30 // jwt time to live adjusted to 1 month
        ]);
    }
}
