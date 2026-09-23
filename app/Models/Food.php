<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\hasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use hasFactory;

    protected $table ='foods';
    protected $guarded = ['id'];
}
