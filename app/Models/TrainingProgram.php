<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingProgram extends Model
{
    protected $fillable = [
        'report_id',
        'theme',
        'participants',
        'summary',
        'start_date',
        'end_date',
        'attachments'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
