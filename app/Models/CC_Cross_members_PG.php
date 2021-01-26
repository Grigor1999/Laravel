<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CC_Cross_members_PG extends Model
{
    use HasFactory;
    public $table='cc_cross_members_pg';
    public $timestamps=false;
    protected $fillable =[];
    protected $guarded = [];

    public function crossMembers(){
        return $this->belongsTo('App\Models\Members','id','cc_member_id');
    }
}
