<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zipcodes extends Model
{
    use HasFactory;
    public $table='zipcodes';
    public $timestamps=false;
    // protected $primaryKey = 'id';    
    // public $incrementing = false;
    // protected $fillable =[];
    // protected $guarded = [];
}
