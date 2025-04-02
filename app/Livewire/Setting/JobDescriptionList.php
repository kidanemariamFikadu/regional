<?php

namespace App\Livewire\Setting;

use App\Models\JobDescription;
use Livewire\Component;

class JobDescriptionList extends Component
{
    public $search;
    public $sortBy = "name";
    public $sortDir = "asc";
    public $perPage = 5;
    public $selectedDate = null;

    public $name;
    public $jobId;

    public function setSortBy($sortBy)
    {
        $this->sortDir = $this->sortBy === $sortBy ? ($this->sortDir === "asc" ? "desc" : "asc") : "asc";
        $this->sortBy = $sortBy;
    }

    public function saveJob()
    {
        $this->validate([
            'name' => 'required|max:255',
        ]);

        if ($this->jobId) {
            $this->validate(['name' => 'unique:job_descriptions,name,' . $this->jobId]);
            $jobDescription = JobDescription::find($this->jobId);
            $jobDescription->update([
                'name' => $this->name,
            ]);
        } else {

            $jobDescription = JobDescription::create([
                'name' => $this->name,
            ]);
        }

        $this->dispatch('job-updated', name: $jobDescription->name);
        $this->reset(['name','jobId']);
    }

    public function editJob($jobDescription)
    {
        $this->name = $jobDescription['name'];
        $this->jobId = $jobDescription['id'];
    }

    public function resetForm()
    {
        $this->reset(['name', 'jobId']);
    }

    public function render()
    {
        return view('livewire.setting.job-description-list', [
            'jobDescriptionList' => JobDescription::search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ]);
    }
}
