<?php

namespace App\Livewire;

use Livewire\Component;

class GitPractice extends Component
{
    public int $count = 0;

    public function render()
    {
        return view('livewire.git-practice');
    }

    public function increment()
    {

        $this->count++;

        if ($this->count === 10) {
            $this->count = 0;
        }
    }


}
