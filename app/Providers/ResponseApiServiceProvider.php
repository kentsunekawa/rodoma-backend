<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ResponseApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function($data) {
            return response()->json($data);
        });

        // Response::macro('error', function($message, array $errors = [], $status = ResponseStatus::HTTP_INTERNAL_SERVER_ERROR) {
        //     return response()->json([
        //         'message' => $message,
        //         'errors' => $errors,
        //     ], $status);
        // });
    }
}
