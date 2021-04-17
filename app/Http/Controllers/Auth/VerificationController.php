<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
        $this->middleware('throttle:6,1');
    }

    public function verify(Request $request)
    {
        $user = User::find($request->route('id'));
        if(!$user->email_verified_at) {
            $user->markEmailAsVerified();
            event(new Verified($user));
            return new JsonResponse([
                'status' => 'success_email_verify',
            ]);
        }
        return new JsonResponse([
            'status' => 'fail_email_verify',
        ], 401);
    }

    public function resend(Request $request)
    {
        $user = User::where('email', $request->get('email'))->get()->first();

        if(!$user) {
            return new JsonResponse([
                'status' => 'error_no_user_exists',
            ], 400);
        }

        if($user->hasVerifiedEmail()) {
            return new JsonResponse([
                'status' => 'fail_already_verified',
            ], 400);
        }

        $user->sendEmailVerificationNotification();

        return new JsonResponse([
            'status' => 'success_sent_verify_mail',
        ]);
    }
}
