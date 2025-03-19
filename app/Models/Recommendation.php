<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $fillable = [
        'report_id',
        'recommendation',
    ];

    public function report(){
        return $this->belongsTo(Report::class);
    }
}
