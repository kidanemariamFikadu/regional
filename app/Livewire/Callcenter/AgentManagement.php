<?php

namespace App\Livewire\Callcenter;

use App\Models\User;
use Livewire\Component;

class AgentManagement extends Component
{
    public $search;
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
        return view('livewire.callcenter.agent-management', [
            'agents' => User::where('job_description_id', 12)->search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ]);
    }
}
