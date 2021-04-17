<?php

return [
    'url' => env('FRONTEND_URL', 'http://localhost:3000'),
    'reset_pass_url' => env('RESET_PASS_URL', '/resetPass?token='),
    'email_verify_url' => env('FRONTEND_EMAIL_VERIFY_URL', '/emailVerify?queryUrl='),
];
