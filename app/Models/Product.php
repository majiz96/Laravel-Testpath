<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('name','price','description','show')]
class Product extends Model
{
    protected $table = 'products';
}
