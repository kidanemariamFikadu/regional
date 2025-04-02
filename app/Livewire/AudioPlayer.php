<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class AudioPlayer extends Component
{
    public $audioUrl;
    public $filename = 'sample.mp3'; // Default file (you can pass it dynamically)

    public function loadAudio()
    {
        $this->audioUrl = Storage::disk('s3')->temporaryUrl(
            'uploads/u7Ae14G51f.m4a',
            now()->addMinutes(5),
            [
                'ResponseContentType' => 'audio/mpeg',
                'ResponseContentDisposition' => 'inline; filename="' . $this->filename . '"',
            ]
        );
    }

    public function render()
    {
        return view('livewire.audio-player');
    }
}
