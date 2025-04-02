<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentAudioEvaluation extends Model
{
    protected $fillable=[
        "agent_audio_file_id",
        "evaluation_question_id",
        "value",
        "score",
        "remarks",
    ];

    public function agentAudioFile()
    {
        return $this->belongsTo(AgentAudioFile::class, 'agent_audio_file_id');
    }

    public function agentAudioEvaluation()
    {
        return $this->belongsTo(EvaluationQuestion::class, 'evaluation_question_id');
    }
}
