<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PLZ_group extends Model
{
    use HasFactory;
    public $table='cc_plz_group';
    public $timestamps=false;
    protected $primaryKey = 'cc_pg_name';    
    protected $fillable =[];
    protected $guarded = [];
    public $incrementing = false;

    // public function crossMembers(){

    //     return $this->belongsToMany('App\Models\Members');

    //     // return $this->belongsTo('App\Models\CC_Cross_members_PG','cc_pg_name','cc_pg_name');
    // }
    public function crossMembers(){
        return $this->belongsToMany('App\Models\Members', 'cc_cross_members_pg','cc_pg_name','cc_member_id');
    }
}
