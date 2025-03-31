<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class AddUserToRegionModal extends ModalComponent
{
    public $region_id;
    public $user_id;
    public $search;

    public function mount($region_id)
    {
        $this->region_id = $region_id;
    }


    public function render()
    {
        return view('livewire.add-user-to-region-modal', [
            'users' => User::search($this->search)
                ->paginate(10)
        ]);
    }
}
