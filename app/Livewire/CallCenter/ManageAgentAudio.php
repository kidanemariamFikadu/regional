<?php

namespace App\Livewire\CallCenter;

use App\Models\AgentEvaluationMonth;
use App\Models\Setting;
use Livewire\Component;

class ManageAgentAudio extends Component
{
    public $currentMonth;

    public function mount()
    {
        $this->currentMonth = Setting::where('key', 'active_month')->first()->value;
    }

    function closeMonth()
    {
        // $unevalautedAgents = AgentEvaluationMonth::where('month', $this->currentMonth)
        //     ->whereDoesntHave('fileEvaluatedPermonth')
        //     ->with('fileEvaluatedPermonth')->count();

        $unevalautedAgents = AgentEvaluationMonth::where('month', $this->currentMonth)
            ->whereHas('filesPerMonth', function ($query) {
                $query->where('status', 'not_evaluated'); // or whatever status you're checking
            })->count();


        if ($unevalautedAgents > 0) {
            session()->flash('error', 'There are still agents that have not been evaluated for this month.');
            return;
        }
        $this->currentMonth = date('Y-m', strtotime($this->currentMonth . ' +1 month'));
        Setting::where('key', 'active_month')->update(['value' => $this->currentMonth]);
        session()->flash('success', 'The month has been closed successfully.');
    }

    public function render()
    {

        return view('livewire.call-center.manage-agent-audio', [
            'agentsUnderEvaluation' => AgentEvaluationMonth::where('month', $this->currentMonth)
                ->with('agent', 'filesPerMonth')->paginate(),
        ]);
    }
}
