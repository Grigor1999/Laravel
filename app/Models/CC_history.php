<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CC_history extends Model
{
    use HasFactory;
    public $table = 'cc_history';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['immo_id'];
    protected $guarded = ['id'];

    public function members()
    {
        return $this->belongsTo('App\Models\Members', 'member_id', 'id');
    }
    public function getStatus()
    {
        return $this->belongsTo('App\Models\Status', 'status', 'id');
    }
    public function getImmo()
    {
        return $this->belongsTo('App\Models\CC_immo', 'immo_id', 'ID');
    }
    public function getCallDuration($day, $member_id)
    {
        $result = $this->where('member_id', $member_id)->where(DB::raw("(DATE(timestamp))"), $day)->get();
        $duration = 240;
        foreach ($result as $key => $item) {
            if ($key < 1) continue;
            $lastcall  = strtotime($result[$key - 1]->timestamp);
            $thiscall = strtotime($item->timestamp);
            if (($thiscall - $lastcall) < 780) {
                $duration += ($thiscall - $lastcall);
            } else {
                $duration += 240;
            }
        }
        return $duration;
    }
}
