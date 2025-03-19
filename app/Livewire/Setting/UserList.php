<?php

namespace App\Livewire\Setting;

use App\Models\User;
use Livewire\Component;

class UserList extends Component
{
    public $search;
    public $sortBy="name";
    public $sortDir="asc";


    public function render()
    {
        return view('livewire.setting.user-list', [
            "userList" => User::search($this->search)
                ->paginate(10)
        ]);
    }
}
