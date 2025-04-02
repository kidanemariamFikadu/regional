<?php

namespace App\Livewire\CallCenter;

use App\Models\EvaluationQuestion;
use Livewire\Component;

class Evaluation extends Component
{
    public $sortBy = "name";
    public $sortDir = "asc";
    public $perPage = 10;

    public function setSortBy($sortBy)
    {
        $this->sortDir = $this->sortBy === $sortBy ? ($this->sortDir === "asc" ? "desc" : "asc") : "asc";
        $this->sortBy = $sortBy;
    }


    public function render()
    {
        return view('livewire.call-center.evaluation',[
            'evaluations' => EvaluationQuestion::with(['createdBy', 'updatedBy'])->orderBy('category')->paginate(10),
        ]);
    }
}
