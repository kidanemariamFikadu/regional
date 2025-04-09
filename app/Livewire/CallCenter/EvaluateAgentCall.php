<?php

namespace App\Livewire\CallCenter;

use App\Models\AgentAudioEvaluation;
use App\Models\AgentAudioFile;
use App\Models\AgentEvaluationMonth;
use App\Models\EvaluationQuestion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use phpDocumentor\Reflection\Types\Integer;

class EvaluateAgentCall extends Component
{
    public AgentEvaluationMonth $agentEvaluationMonth;
    public $audioUrl;
    public $audioId;
    public $remark;
    public $responses = [];
    public $evaluationQuestions;

    public function mount($agentEvaluationMonth)
    {
        $this->agentEvaluationMonth = $agentEvaluationMonth;
        $this->evaluationQuestions = EvaluationQuestion::where('status', 'active')->get();
        foreach ($this->evaluationQuestions as $question) {
            $this->responses[$question->id] = null;
        }
    }

    public function onOptionSelected($value)
    {
        $this->audioId = $value;
        if ($value) {
            $this->audioUrl = AgentAudioFile::where('id', $this->audioId)->first()->fileAwsUrl;

            $audioEvaluation = AgentAudioEvaluation::where('agent_audio_file_id', $this->audioId)->get();
            if ($audioEvaluation->count() > 0) {
                foreach ($audioEvaluation as $evaluation) {
                    $this->responses[$evaluation->evaluation_question_id] = $evaluation->score;
                }
            } else {
                $this->reset(['responses', 'remark']);
            }
        }

        $this->remark = $this->agentEvaluationMonth->filesPerMonth->where('id', $this->audioId)->first()?->remarks;
    }

    public function evaluationValue()
    {
        $this->validate([
            'responses' => 'required|array',
            'responses.*' => 'required|integer|min:0',
            'audioId' => 'required|numeric'
        ], [
            'audioId.required' => __('Please select an audio file to evaluate.'),
            'responses.*.required' => __('Please evaluate this question.'),
        ]);

        $totalScore = 0;
        foreach ($this->responses as $key => $response) {
            $totalScore += intval($response);
            AgentAudioEvaluation::updateOrCreate(
                [
                    "agent_audio_file_id" => $this->audioId,
                    "evaluation_question_id" => $key,
                ],
                [
                    "value" => $this->evaluationQuestions->where('id', $key)->first()->value,
                    "score" => $response,
                ]
            );
        }


        $audioFile = AgentAudioFile::where('id', $this->audioId)->first();
        $audioFile->status = 'evaluated';
        $audioFile->score = $totalScore;
        $audioFile->evaluated_by = Auth::user()->id;
        $audioFile->evaluated_at = now();
        $audioFile->remarks = $this->remark;
        $audioFile->save();

        $evaluatedAudioFiles = $this->agentEvaluationMonth->fileEvaluatedPermonth()->get();
        $totalScoreSum = 0;

        $totalScoreSum = $evaluatedAudioFiles->sum('score');
        $evaluatedFileCount = $evaluatedAudioFiles->count();

        $averageScore = $evaluatedFileCount > 0 ? $totalScoreSum / $evaluatedFileCount : 0;

        $this->agentEvaluationMonth->total_score = $averageScore;
        $this->agentEvaluationMonth->remarks = $this->remark;
        $this->agentEvaluationMonth->save();


        $this->reset(['audioId', 'audioUrl', 'responses', 'remark']);

        $this->dispatch('Audio-Evaluated');
    }

    public function render()
    {
        return view('livewire.call-center.evaluate-agent-call', [
            'agentAudioFiles' => $this->agentEvaluationMonth,
        ]);
    }
}
