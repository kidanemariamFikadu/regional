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
    public $filename = 'sample.mp3';
    public function mount(){
        // $this->imageUrl = Storage::disk('s3')->get('uploads/ftprc0dXKCXEFf43a72vy88MQ1k4mPGOCDyczSSK.jpg');
        // $this->imageUrl = Storage::disk('s3')->url('uploads/u7Ae14G51f.m4a');
        $this->imageUrl = Storage::disk('s3')->temporaryUrl(
            'uploads/u7Ae14G51f.m4a',
            now()->addMinutes(5),
            [
                'ResponseContentType' => 'audio/mpeg',
                'ResponseContentDisposition' => 'inline; filename="' . $this->filename . '"',
            ]
        );
    }
    function uploadData()
    {

        $file = $this->image; // Assume input field name is 'image'
        logger("file");
        $path = $file->store('uploads', 's3');
        // $this->imageUrl = Storage::disk('s3')->url($path);
        $this->imageUrl =Storage::disk('s3')->get($path);
    }
    public function render()
    {
        return view('livewire.call-center.index');
    }
}
