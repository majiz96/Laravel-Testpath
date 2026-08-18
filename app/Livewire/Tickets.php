<?php

namespace App\Livewire;

use App\Models\Ticket;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Tickets extends Component
{

    #[Validate('required|numeric|max:3|min_digits:1')]
    public $id;
    #[Validate('required|string')]
    public $type;
    #[Validate('required|max_digits:100|min_digits:1|unique:tickets|numeric')]
    public $chair;
    #[Validate('required|max_digits:4|numeric')]
    public $duration;


    public function save()
    {
        $this->validate();

        $data = ['id' => $this->id, 'type' => $this->type, 'chair' => $this->chair, 'duration' => $this->duration];

        Ticket::create($data);

        $this->reset();
    }

    #[Computed]
    public function Tickets()
    {
        Ticket::all()->toArray();
    }

    public function render()
    {
        return view('livewire.tickets');
    }
}
