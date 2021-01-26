<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class CC_immo extends Model
{
    use HasFactory;
    public $table='cc_immo';
    public $timestamps=false;
    protected $primaryKey = 'ID';    
    public $incrementing = false;
    protected $fillable =[];
    protected $guarded = [];


    public function lastUser(){
        return $this->belongsTo('App\Models\Members','last_user','id');
    }
    public function history(){
        return $this->hasMany('App\Models\CC_history','immo_id','ID');
    }
    public function meetingUser(){
        return $this->belongsTo('App\Models\Members','meeting_user','id');
    }
    public function getStatus(){
        return $this->belongsTo('App\Models\Status','status','id');
    }
}
