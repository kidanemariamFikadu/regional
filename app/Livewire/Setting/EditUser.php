<?php

namespace App\Livewire\Setting;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class EditUser extends Component
{
    public $user;
    public $name;
    public $email;
    public $role=[];

    public function mount($user)
    {
        $this->user = User::find($user);
        $this->name = $this->user->name;
        $this->email= $this->user->email;
        $this->role = $this->user->roles->pluck('name')->toArray();

    }

    public function updateRole(){

    }

    public function editUser(){
        $this->validate([
            'name' => 'required|string|max:255',
            // 'email'=> 'required|email|unique:users,email,except,id',
            'role'=> ['required','array'],
            'role.*'=> ['required','exists:roles,name']
        ]);

        $this->user->update([
            'name'=>$this->name,
            'email'=>$this->email
        ]);

        $this->user->syncRoles($this->role);

        $this->dispatch('user-updated', name: $this->user->name);
    }
    
    public function render()
    {
        return view('livewire.setting.edit-user',[
            'roleList'=>Role::all()
        ]);
    }
}
