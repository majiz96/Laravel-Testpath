<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Http\RedirectResponse;

class Login extends Component
{
    #[Validate('required|email')]
    public string $email = '';

    #[Validate('required|min:8')]
    public string $password = '';
    public bool $remember = false;

    public function login()
    {
        $this->validate();

        $credentials = ['email' => $this->email, 'password' => $this->password];

        if (auth()->attempt($credentials,$this->remember))
        {
            request()->session()->regenerate();
            return redirect()->intended(config('fortify.home'));
        }

        $this->addError('email', __('auth.failed'));

    }

    public function render()
    {
        return view('livewire.auth.login')
            ->layout('layouts.auth');
    }
}
