<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentEvaluationMonth extends Model
{
    protected $fillable = [
        "agent_id",
        "month",
        "year",
        "total_score",
        "remarks",
    ];

    public function agent(){
        return $this->belongsTo(User::class);
    }

    public function filesPerMonth(){
        return $this->hasMany(AgentAudioFile::class, 'evaluation_month_id');
    }

    public function fileEvaluatedPermonth(){
        return $this->hasMany(AgentAudioFile::class,'evaluation_month_id')->where('status','evaluated');
    }
}
