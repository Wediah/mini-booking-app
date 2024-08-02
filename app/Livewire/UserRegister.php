<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UserRegister extends Component
{
    #[Validate('required|string|min:3')]
    public string $name = '';

    #[Validate('required|email|min:3|unique:users,email')]
    public string $email = '';

    #[Validate('required|string|min:6')]
    public string $password = '';

    public function register()
    {
        $this->validate();

        User::firstOrCreate(
            $this->only(['name', 'email', 'password']),
        );

        session()->flash('success', 'You have registered successfully.');
        return redirect(route('login'));
    }
    public function render()
    {
        return view('livewire.user-register')
            ->layout('layouts.guest');
    }
}
