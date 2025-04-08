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
    public function render()
    {

        return view('livewire.call-center.manage-agent-audio', [
            'agentsUnderEvaluation' => AgentEvaluationMonth::where('month', $this->currentMonth)
                ->with('agent','filesPerMonth')->paginate(),
        ]);
    }
}
