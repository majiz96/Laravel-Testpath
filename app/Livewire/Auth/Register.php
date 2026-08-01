<?php

namespace App\Livewire\Auth;


use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\CreatesNewUsers;

use Livewire\Attributes\Validate;
use Livewire\Component;


class Register extends Component
{
    #[Validate('required|min:3')]
    public string $name = '';
    #[Validate('required|email|unique:users,email')]
    public string $email = '';
    #[Validate('required|min:8|confirmed')]
    public string $password = '';
    public string $password_confirmation = '';
    public function register(CreatesNewUsers $newUser)
    {
        $this->validate();

        $data =
            [
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
            ];

        $user = $newUser->create($data);

        event(new Registered($user));

        Auth::login($user);

        session()->regenerate();

        return redirect()->route('verification.notice');

    }
    public function render()
    {
        return view('livewire.auth.register')->layout('layouts.auth');
    }


}
