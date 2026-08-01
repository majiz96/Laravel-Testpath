<?php

namespace App\Livewire\Auth;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Livewire\Component;

class VerifyEmail extends Component
{
    public function mount()
    {
        if (auth()->user()->hasVerifiedEmail()) {
            return redirect()->intended(config('fortify.home'));
        }
    }
    public function resend()
    {
        auth()->user()->sendEmailVerificationNotification();

        session()->flash('success', 'Verification link sent!');

    }

    public function logout()
    {
        auth()->logout();
        session()->regenerate();
        session()->regenerateToken();
        return redirect()->intended(config('fortify.home'));
    }

    public function render()
    {
        return view('livewire.auth.verify-email')->layout('layouts.auth');
    }
}
