<?php

namespace App\Livewire\Setting;

use App\Models\RegionalOffice;
use App\Models\User;
use Livewire\Component;

class EditRegionalOffice extends Component
{
    public $regionalOffice;
    public $search;
    public $sortBy = "name";
    public $sortDir = "asc";
    public $perPage = 10;


    //regional form variables
    public $name = '';
    public $region = '';
    public $country = '';

    public function mount(RegionalOffice $regionalOffice)
    {
        $this->regionalOffice = $regionalOffice;
        $this->name = $regionalOffice->name;
        $this->region = $regionalOffice->region;
        $this->country = $regionalOffice->country;
    }

    public function saveRegionalOffice()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:regional_offices,name,' . $this->regionalOffice->id,
            'region' => 'required|string|max:255',
            'country' => 'required|string',
        ]);

        $this->regionalOffice->name = $this->name;
        $this->regionalOffice->country = $this->country;
        $this->regionalOffice->region = $this->region;
        $this->regionalOffice->save();

        $this->dispatch('regional-office-updated', name: $this->regionalOffice->name);
    }

    public function render()
    {
        $employeelist = User::where('regional_office_id', $this->regionalOffice->id)
            ->paginate($this->perPage);
        return view('livewire.setting.edit-regional-office', [
            'employees' => $employeelist,
        ]);
    }
}
