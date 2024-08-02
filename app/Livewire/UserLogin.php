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
        $attributes = $this->validate(['email' => 'required|string|email|min:3', 'password' => 'required|string|min:3']);

        if (auth()->attempt($attributes)) {
            session()->flash('message', 'Login Successful');
            return redirect()->intended('/dashboard');
        }
        else {
            session()->flash('error', 'Invalid credentials');
        }
    }

    public function render()
    {
        return view('livewire.user-login')
            ->layout('layouts.guest');
    }
}
