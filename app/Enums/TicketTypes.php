<?php

namespace App\Enums;

enum TicketTypes: string
{
    //
    case guest = 'Guest';
    case normal = 'Normal';
    case vip = 'VIP';
}
