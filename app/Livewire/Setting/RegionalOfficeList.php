<?php

namespace App\Livewire\Setting;

use App\Models\RegionalOffice;
use Flux\Flux;
use Livewire\Component;

class RegionalOfficeList extends Component
{
    // list variables and methods
    public $search;
    public $sortBy = "name";
    public $sortDir = "asc";
    public $perPage = 10;
    public $selectedDate = null;

    public function setSortBy($sortBy)
    {
        $this->sortDir = $this->sortBy === $sortBy ? ($this->sortDir === "asc" ? "desc" : "asc") : "asc";
        $this->sortBy = $sortBy;
    }

    public function render()
    {
        return view('livewire.setting.regional-office-list', [
            'regionalOffices' => RegionalOffice::search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ]);
    }

    //Create variables and methods
    public $name = '';
    public $region = '';
    public $country = '';
    public $showCreateRegionalOfficeModal = false;
    public $showRegionalOfficeDeleteModal = false;
    public $aboutTodelete;

    public function saveRegionalOffice()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:regional_offices,name',
            'region' => 'required|string|max:255',
            'country' => 'required|string'
        ]);

        $regionalOffice = RegionalOffice::create([
            'name' => $this->name,
            'region' => $this->region,
            'country' => $this->country,
        ]);

        $this->dispatch('user-updated', name: $regionalOffice->name);

        $this->showCreateRegionalOfficeModal = false;
        $this->reset();
    }

    public function regionalOfficeDeleteModal($aboutTodelete)
    {
        $this->aboutTodelete = $aboutTodelete;
        $this->showRegionalOfficeDeleteModal = true;
    }
}
