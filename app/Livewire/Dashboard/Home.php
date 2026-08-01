<?php

namespace App\Livewire\Dashboard;

use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public bool $option = false;
    public bool $search = false;

    public string $stats = '';

    public string $destination;

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

    public function sayWelcome()
    {
        $this->stats = 'sent to '.' '.auth()->user()->name;

        Auth::user()->notify(new WelcomeNotification());

//        Notification::route('mail','majiz24.en@gmail.com')->notify(new WelcomeNotification());
    }

    public function sayWelcomeTo()
    {
        $this->stats = 'sent to'.' '.$this->destination;

        Notification::route('mail',$this->destination)->notify(new WelcomeNotification());

        $this->reset('destination');
    }

    public function sayWelcomeLater()
    {
        $this->stats = 'sent to '.' '.auth()->user()->name.' '.' Later';

        $notification = (new WelcomeNotification())->delay(now()->addMinute());

        auth()->user()->notify($notification);
    }

    public function markAsRead($id)
    {
        if (Auth::check())
        {
            $notification = Auth::user()->notifications()->find($id);

            if ($notification)
            {
//                $notification->read_at = now();
                $notification->markAsRead();

                $this->stats = 'the notification was marked as read';

            }

        }
    }

    public function render()
    {
        $user = auth()->user();

        $notifications = $user->notifications;

        $unread = $user->unreadNotifications;

        return view('livewire.dashboard.home', compact('user', 'notifications', 'unread'));
    }
}
