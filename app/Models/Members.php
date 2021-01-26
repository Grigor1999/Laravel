<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Members extends Authenticatable
{
    use HasFactory;
    public $table='members';
    public $timestamps=false;


    
}
