<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CC_members_plz extends Model
{
    use HasFactory;
    public $table='cc_members_plz';
    public $timestamps=false;
    protected $primaryKey = 'id';    
    public $incrementing = false;
    protected $fillable =[];
    protected $guarded = [];

    public function members(){
        return $this->belongsTo('App\Models\Members','member_id','id');
    }
    public function zipcodes(){
        return $this->hasMany('App\Models\Zipcodes','PLZ','PLZ')->orderBy('Ort', 'asc');
    }
}
