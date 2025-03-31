<?php

namespace App\Livewire\Setting;

use App\Models\JobDescription;
use App\Models\RegionalOffice;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class EditUser extends Component
{
    public $user;
    public $name;
    public $email;
    public $role = [];
    public $phone_number;
    public $regionalOfficeId;
    public $job_description_id;

    public function mount($user)
    {
        $this->user = User::find($user);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->role = $this->user->roles->pluck('name')->toArray();
        $this->phone_number = $this->user->phone_number;
        $this->regionalOfficeId = $this->user->regional_office_id;
        $this->job_description_id = $this->user->job_description_id;
    }

    public function updateRole() {}

    public function editUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|email|unique:users,email,'.$this->user->id.',id',
            'role' => ['required', 'array'],
            'role.*' => ['required', 'exists:roles,name'],
            'phone_number' => 'required|string|max:255',
            'regionalOfficeId' => 'required|exists:regional_offices,id',
            'job_description_id' => 'required|exists:job_descriptions,id',
        ]);

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'regional_office_id' => $this->regionalOfficeId,
            'job_description_id' => $this->job_description_id,
        ]);

        $this->user->syncRoles($this->role);

        $this->dispatch('user-updated', name: $this->user->name);

        redirect(route('setting.user-list'));
    }

    public function render()
    {
        return view('livewire.setting.edit-user', [
            'roleList' => Role::all(),
            'regionalOffices' => RegionalOffice::all(),
            'jobDescriptions' => JobDescription::all(),
        ]);
    }
}
