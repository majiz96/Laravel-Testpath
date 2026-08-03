<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['body', 'title'])]
class Post extends Model
{
    //
    protected $table = 'posts';
}
