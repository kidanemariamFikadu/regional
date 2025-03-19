<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'report_id',
        'theme',
        'participants',
        'summary',
        'decisions',
        'action_items',
        'next_steps',
        'attachments',
        'date'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
