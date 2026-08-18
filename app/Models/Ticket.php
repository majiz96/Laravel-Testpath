<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('type','chair_number','duration', 'user_id', 'chair')]
class Ticket extends Model
{
    //
    protected $table = 'tickets';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::Class);
    }
}
