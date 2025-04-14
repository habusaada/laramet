<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());

        // ✅ Begin profile checks here
        $user = Auth::user();
        $profile = $user->profile;

        if (!$profile) {
            Auth::logout();
            throw ValidationException::withMessages([
                'profile_status' => 'Your profile is missing. Please contact support.',
            ]);
        }

        if ($profile->status === 'under_review') {
            Auth::logout();
            throw ValidationException::withMessages([
                'profile_status' => 'Your account is under review. You will be notified once approved.',
            ]);
        }

        if ($profile->status === 'rejected') {
            Auth::logout();
            throw ValidationException::withMessages([
                'profile_status' => 'Your account was rejected. Reason: ' . ($profile->rejection_reason ?? 'No reason provided.'),
            ]);
        }

        if ($profile->status !== 'approved') {
            Auth::logout();
            throw ValidationException::withMessages([
                'profile_status' => 'Your account is not approved yet.',
            ]);
        }

        if (!$profile->is_active) {
            Auth::logout();
            throw ValidationException::withMessages([
                'profile_status' => 'Your account is currently deactivated. Please contact support.',
            ]);
        }
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());
        $minutes = ceil($seconds / 60);

        throw ValidationException::withMessages([
            'failed_attempts' => "You’ve entered incorrect credentials 5 times.
                        For security reasons, your account has been temporarily locked.
                        Please try again in {$minutes} minute(s), or reset your password if needed.",
        ]);

    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
