<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationQuestion extends Model
{
    protected $fillable = [
        'Question',
        'value',
        'category',
        'status',
        'updated_by',
        'created_by',
    ];

    protected $casts = [
        'value' => 'integer',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
