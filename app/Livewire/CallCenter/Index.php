<?php

namespace App\Livewire\CallCenter;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    public $image;
    public $imageUrl;
    public function mount(){
        $this->imageUrl = Storage::disk('s3')->url('judPh3hIWlxnvHnlkyxAgOuo4RRFKibctPRsxxlR.jpg');
    }
    function uploadData()
    {

        $file = $this->image; // Assume input field name is 'image'
        logger("file");
        $path = $file->store('uploads', 's3');
        $this->imageUrl = Storage::disk('s3')->url($path);
    }
    public function render()
    {
        return view('livewire.call-center.index');
    }
}
