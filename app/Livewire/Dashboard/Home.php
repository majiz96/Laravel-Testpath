<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Home extends Component
{
    public bool $option = false;
    public bool $search = false;

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
        return redirect('/');
    }

    public function render()
    {
        $user = auth()->user();
        return view('livewire.dashboard.home', compact('user'));
    }
}
