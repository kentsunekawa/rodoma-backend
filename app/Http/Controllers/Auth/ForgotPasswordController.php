<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validate = $this->validateEmail($request->all());

        if($validate->fails()) {
            $response = [
                'status' => 'error_validation',
                'data' => [
                    'errors' => [
                        'email' => ['email_required']
                    ],
                ],
            ];
            return new JsonResponse($response, 400);
        }

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    public function validateEmail(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email',
        ]);
    }

    protected function sendResetLinkResponse(): JsonResponse
    {
        $result = [
            'status' => 'success_sent_reset_password_mail',
        ];

        return new JsonResponse($result, 200);
    }

    protected function sendResetLinkFailedResponse(Request $request, $response): JsonResponse
    {
        return new JsonResponse([
            'status' => trans($response),
        ], 400);
    }

}
