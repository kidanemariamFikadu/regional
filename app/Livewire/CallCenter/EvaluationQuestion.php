<?php

namespace App\Livewire\CallCenter;

use App\Models\EvaluationQuestion as ModelsEvaluationQuestion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EvaluationQuestion extends Component
{
    public $question;
    public $value;
    public $status;
    public $category;
    public $id;

    public $totalEvaluatioValue;

    public function mount(ModelsEvaluationQuestion $question)
    {
        if ($question) {
            $this->question = $question->Question;
            $this->value = $question->value;
            $this->status = $question->status;
            $this->category = $question->category;
            $this->id = $question->id;
        }

        $this->totalEvaluatioValue = ModelsEvaluationQuestion::where("status", "active")->sum("value");
    }

    public function saveQuestion()
    {
        $rules = [
            "question" => "required|string",
            "value" => ["required", "integer", "min:0", "max:100", function ($attribute, $value, $fail) {
                $totalValue = ModelsEvaluationQuestion::where("status", "active")->where('id', '!=', $this->id)->sum("value");
                if (($totalValue + $value) > 100) {
                    $fail("The total value of active questions cannot exceed 100");
                }
            }],
        ];
        logger("here");

        if ($this->id) {
            $rules["status"] = "required|in:active,inactive";
        }


        $this->validate($rules);
        if (!$this->id) {
            $question = ModelsEvaluationQuestion::create([
                "Question" => $this->question,
                "value" => $this->value,
                "category" => $this->category,
                "created_by" => Auth::user()->id,
                "updated_by" => Auth::user()->id,
            ]);
        } else {
            $question = ModelsEvaluationQuestion::find($this->id);
            $question->update([
                "Question" => $this->question,
                "value" => $this->value,
                "category" => $this->category,
                "status" => $this->status,
                "updated_by" => Auth::user()->id,
            ]);
        }
        $this->dispatch('question-updated', name: $question->question);

        redirect(route('call-center.evaluation'));
    }

    public function render()
    {
        return view('livewire.call-center.evaluation-question');
    }
}
