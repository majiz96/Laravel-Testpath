<?php

namespace App\Livewire;

use App\Enums\TicketTypes;
use App\Models\Ticket;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Tickets extends Component
{

    #[Validate('required|numeric|max:3|min_digits:1')]
    public $user;
    #[Validate('required|string')]
    public $type;
    #[Validate('required|max:100|min:1|unique:tickets|numeric')]
    public $chair;
    #[Validate('required|max:4|min:1|numeric')]

    public $duration;
    public string $notice = 'test text';
    public string $noticeTheme = 'danger';
    protected $updateRules = [
        'user' => 'nullable|numeric|exists:users,id',
        'type' => 'nullable|string',
        'chair' => 'nullable|numeric|max:100|min:1',
        'duration' => 'nullable|numeric|max:4|min:1',
    ];

    public $editing = false;

    public function edit($id)
    {
        $this->editing = $id;

        $ticket = Ticket::findOrFail($id);
        $this->user = $ticket->user_id;
        $this->type = $ticket->type;
        $this->chair = $ticket->chair;
        $this->duration = $ticket->duration;
    }
    public function cancel()
    {
        $this->reset('editing','type','chair','duration','user');
    }

    public function save()
    {
        if ($this->editing)
        {
            $this->validate($this->updateRules);

            $ticket = Ticket::findOrFail($this->editing);

            $ticket->update([
                'user_id' => $this->user,
                'type' => $this->type,
                'chair' => $this->chair,
                'duration' => $this->duration,
            ]);

            $this->reset('editing','type','chair','duration','user');
        }
        else
        {
            $this->validate();

            Ticket::create([
                'user_id' => $this->user,
                'chair' => $this->chair,
                'duration' => $this->duration,
                'type' => $this->type,
            ]);

            $this->reset('editing','type','chair','duration','user','notice','noticeTheme');
        }
    }

    public function checkTicket($id)
    {
        if($this->user)
        {
            $this->noticeTheme = "success";
            $this->notice = "ticket selected as ".$this->type;
        }
        else
        {
            $this->noticeTheme = "danger";
            $this->notice = "ticket not selected";
            $this->type = "";
        }
    }

    public function delete($id)
    {
        Ticket::findOrFail($id)->delete();
    }

    public function render()
    {

        $tickets = Ticket::with('user')->get();
        $types = TicketTypes::cases();
        $users = User::all();

        return view('livewire.tickets', compact('types', 'tickets', 'users'));
    }
}
