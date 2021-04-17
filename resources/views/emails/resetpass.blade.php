<div>
    <h3>
        <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>
    </h3>
    <p>
        {{ __('Click link below and reset password.') }}<br>
        {{ __('If you did not request a password reset, no furhter action is required.') }}
    </p>
    <p>
        <a href="{{ $actionUrl }}">{{ $actionText }}</a>
    </p>
</div>
