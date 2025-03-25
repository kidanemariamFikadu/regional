<?php

namespace App\Livewire\Setting;

use App\Models\Employee;
use Livewire\Component;

class AddEmployeeToRegion extends Component
{
    public function render()
    {
        return view('livewire.setting.add-employee-to-region',[
            'employees'=> Employee::orderBy('name','asc')->paginate(10),
        ]);
    }
}
