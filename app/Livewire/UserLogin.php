<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UserLogin extends Component
{
    public string $email = '';

    public string $password = '';

    public function login()
    {
        $attributes = $this->validate(['email' => 'required|string|email|min:3', 'password' => 'required|string']);

        if (! auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    public function render()
    {
        return view('livewire.user-login')
            ->layout('layouts.guest');
    }
}
