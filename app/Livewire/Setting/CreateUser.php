<?php

namespace App\Livewire\Setting;

use App\Models\RegionalOffice;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class CreateUser extends Component
{
    public $role = [];
    public $name;
    public $email;
    public $regionalOfficeId;
    public $password;
    public $password_confirmation;
    public $phone_number;

    public function updateRole(){

    }

    public function saveUser()
    {
        $this->validate([
            "name" => "required|max:255",
            "email" => "required|email|unique:users,email|max:255",
            "password" => "required|min:8|confirmed",
            "role" => "required|array|min:1",
            "role.*" => "required|exists:roles,name",
            "regionalOfficeId" => "required|exists:regional_offices,id",
        ]);

        $user = User::create([
            "name" => $this->name,
            "email" => $this->email,
            "password" => bcrypt($this->password),
            "regional_office_id" => $this->regionalOfficeId,
            "phone_number" => $this->phone_number,
        ]);

        $user->syncRoles($this->role);

        $this->dispatch('user-updated', name: $user->name);

        redirect(route('setting.user-list'));
    }

    public function render()
    {
        return view('livewire.setting.create-user', [
            'roleList' => Role::all(),
            'regionalOffices' => RegionalOffice::all(),
        ]);
    }
}
