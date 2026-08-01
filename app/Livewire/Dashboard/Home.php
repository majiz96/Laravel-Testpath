<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public bool $option = false;
    public bool $search = false;

    public function mount()
    {
        if (Auth::check())
        {
            if(!Auth::user()->hasVerifiedEmail())
            {
                return redirect()->route('login');
            }
        }
        else
        {
            return redirect()->route('login');
        }

    }

    public function toggleOptions()
    {
        !$this->option ? $this->option = true : $this->option = false;
    }

    public function showSearch()
    {
        !$this->search ? $this->search = true : $this->search = false;
    }
    public function logout()
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->intended(config('fortify.home'));
    }

    public function render()
    {
        $user = auth()->user();
        return view('livewire.dashboard.home', compact('user'));
    }
}
