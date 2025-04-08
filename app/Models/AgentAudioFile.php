<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AgentAudioFile extends Model
{
    protected $fillable = [
        "agent_id",
        "evaluation_month_id",
        "file_url",
        "status",
        "call_type",
        "created_by",
        "evaluated_by",
        "evaluated_at",
        "score",
        "remarks"
    ];

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function evaluatedBy()
    {
        return $this->belongsTo(User::class, 'evaluated_by');
    }

    public function evaluationMonth()
    {
        return $this->belongsTo(AgentEvaluationMonth::class, 'evaluation_month_id');
    }
    
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getFileAwsUrlAttribute()
    {
        return $this->imageUrl = Storage::disk('s3')->temporaryUrl(
            $this->file_url,
            now()->addMinutes(60),
            [
                'ResponseContentType' => 'audio/mpeg',
                'ResponseContentDisposition' => 'inline; filename="' . $this->filename . '"',
            ]
        );
    }
}
