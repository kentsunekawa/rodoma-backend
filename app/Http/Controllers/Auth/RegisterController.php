<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        DB::beginTransaction();
        try{
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'icon_url' => config('app.image_url') . '/img/user/icon/default.jpg',
            ]);

            $user->profile()->create([
                'category_id' => 1,
                'specialty_id' => 1,
                'catch_copy' => 'Your catch copy is here.',
                'description' => 'Hi, I am ' . $data['name'] . '.',
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'status' => 'fail_signup',
            ], 500);
        }
        DB::commit();
        return $user;

    }

    public function register(RegisterRequest $request)
    {
        $user = $this->create($request->all());

        event(new Registered($user));

        return new JsonResponse([
            'status' => 'success_signup',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'icon_url' => $user->icon_url,
                ]
            ],
        ]);
    }
}
