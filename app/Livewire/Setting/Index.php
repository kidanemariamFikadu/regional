<?php

namespace App\Livewire\Setting;

use Livewire\Component;

class Index extends Component
{
    public $currentTab="hoem";
    public function render()
    {
        return view('livewire.setting.index');
    }
}
