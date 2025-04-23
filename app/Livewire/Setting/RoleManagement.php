<?php

namespace App\Livewire\Setting;

use Livewire\Component;

class RoleManagement extends Component
{    public $selectedRole = null;
    public $selectedPermissions = [];
    public $isLoading = false;

    public function onOptionSelected($value){
        $this->isLoading = true;
        $this->selectedRole = $value;
        $this->selectedPermissions = \Spatie\Permission\Models\Role::findByName($value)->permissions->pluck('name')->toArray();
        $this->isLoading = false;
    }

    public function savePermission()
    {
        $role = \Spatie\Permission\Models\Role::findByName($this->selectedRole);
        $role->syncPermissions($this->selectedPermissions);
        
        $this->dispatch('user-updated', name: $role->name);
        $this->reset();
    }

    public function render()
    {
        return view('livewire.setting.role-management',[
            'roles' => \Spatie\Permission\Models\Role::all(),
            'permissions' => \Spatie\Permission\Models\Permission::all(),
        ]);
    }
}
