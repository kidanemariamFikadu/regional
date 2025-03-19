<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $fillable = [
        'report_id',
        'challenge',
        'description',
        'proposed_solution',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
