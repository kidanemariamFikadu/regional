<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationQuestion extends Model
{
    protected $fillable = [
        'Question',
        'value',
        'status',
        'updated_by',
        'created_by',
    ];

    protected $casts = [
        'value' => 'integer',
    ];
}
