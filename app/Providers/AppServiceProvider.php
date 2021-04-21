<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        if (\App::environment('production')) {
            \URL::forceScheme('https');
        }

        VerifyEmail::toMailUsing(function ($notifiable) {
            $prefix = config('frontend.url') . config('frontend.email_verify_url');
            $verifyUrl = URL::temporarySignedRoute(
                'verification.verify', now()->addMinutes(60), ['id' => $notifiable->getKey()]
            );

            return (new MailMessage())
                ->subject('メールアドレス認証')
                ->view('emails.verifyEmail')
                ->action('', $prefix . urlencode($verifyUrl));
        });

    }
}
