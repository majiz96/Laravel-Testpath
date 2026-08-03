<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('name','points','trophies')]
class Teams extends Model
{
    //
    protected $table = 'teams';
}
