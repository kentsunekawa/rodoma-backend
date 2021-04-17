<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    private $authManager;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
        // $this->middleware('guest')->except('logout');
    }

    public function login(Request $request): JsonResponse
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $guard = $this->authManager->guard('api');
        $token = $guard->attempt([
            'email' => $email,
            'password' => $password,
        ]);

        if(!$token) {
            return new JsonResponse([
                'status' => 'fail_signin',
            ], 401);
        }

        return $this->respondWithToken($token);
    }

    public function refresh() {
        try {
            return $this->respondWithToken(auth()->refresh());
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return new JsonResponse([
                'status' => 'fail_refresh_token',
            ], 401);
        }
    }

    protected function respondWithToken($token) {
        $user = auth()->user();
        if($user) {
            $user = [
                'id' => $user['id'],
                'name' => $user['name'],
                'icon_url' => $user['icon_url'],
            ];
        }
        return new JsonResponse([
            'status' => 'success_signin',
            'data' => [
                'user' => $user,
                'token' => $token,
                'expires_in' => auth()->factory()->getTTL() * 60,
            ],
        ]);
    }

    public function getUserByToken() {
        $user = auth()->user();
        return new JsonResponse([
            'status' => 'success_signin',
            'data' => [
                'user' => [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'icon_url' => $user['icon_url'],
                ],
            ],
        ], 200);
    }
}
