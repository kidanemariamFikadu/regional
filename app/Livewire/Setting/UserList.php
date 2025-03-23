<?php

namespace App\Livewire\Setting;

use App\Models\User;
use Livewire\Component;

class UserList extends Component
{
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
        return view('livewire.setting.user-list', [
            "userList" => User::search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ]);
    }
}
