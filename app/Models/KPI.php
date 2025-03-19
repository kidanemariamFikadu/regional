<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KPI extends Model
{
    protected $fillable = [
        'report_id',
        'name',
        'target',
        'actual_result',
        'remarks',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
