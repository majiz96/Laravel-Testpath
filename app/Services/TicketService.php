<?php

namespace App\Services;

use App\Exceptions\TicketLimitExceedException;
use App\Models\Ticket;
use App\Models\User;

class TicketService
{
    public function countTickets()
    {
        $count = Ticket::where('type','vip')->count();

        if($count >= 4)
        {
            throw new TicketLimitExceedException('The VIP limit is reached, check tomorrow.');
        }

        return $count;
    }
    public function countVipTickets($userId)
    {

        $vip = Ticket::where('type','vip')
            ->where('user_id',$userId)
            ->count();

        $all = Ticket::where('type','vip')->count();

        if($vip >= 1)
        {
            throw new TicketLimitExceedException('Every user can have just one VIP ticket');
        }

        return $all;

    }

    public function userTicketCount($userId)
    {
        $user = Ticket::where('user_id',$userId)->count();

        if($user >= 3)
        {
            throw new TicketLimitExceedException('Every user can have just 3 ticket');
        }

        return $user;
    }
}
