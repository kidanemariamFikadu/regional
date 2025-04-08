<?php

namespace App\Livewire\CallCenter;

use App\Models\AgentAudioFile;
use App\Models\AgentEvaluationMonth;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class AddAgentAudio extends ModalComponent
{
    use WithFileUploads;
    public $agent_id;
    public $call_type;
    public $audio_file;
    public $currentMonth;

    public function mount($agent_id = null)
    {
        $this->currentMonth = Setting::where('key', 'active_month')->first()->value;
        $this->agent_id = $agent_id;
    }

    function saveAgentAudio()
    {

        $this->validate([
            "agent_id" => "required|exists:users,id",
            "call_type" => "required",
            "audio_file" => "required|mimetypes:audio/mpeg,audio/x-wav,audio/ogg,audio/flac,audio/mp4,video/3gpp|max:10240",
        ]);

        $agentEvaluationMonth = AgentEvaluationMonth::where('month', $this->currentMonth)
            ->where('agent_id', $this->agent_id)
            ->first();
        if (!$agentEvaluationMonth) {
            $agentEvaluationMonth = AgentEvaluationMonth::create([
                'agent_id' => $this->agent_id,
                'month' => $this->currentMonth,
            ]);
        }
        $existingRecord = AgentAudioFile::where([
            'agent_id' => $this->agent_id,
            'evaluation_month_id' => $agentEvaluationMonth->id,
            'call_type' => $this->call_type,
        ])->first();

        if ($existingRecord) {
            $this->addError('call_type', 'A record with the same agent, month, and call type already exists.');
            return;
        }

        $file = $this->audio_file; // Assume input field name is 'image'
        $path = $file->store('uploads', 's3');

        if ($path) {
            $agentAudioFile = AgentAudioFile::create([
                'agent_id' => $this->agent_id,
                'call_type' => $this->call_type,
                'file_url' => $path,
                'evaluation_month_id' => $agentEvaluationMonth->id,
                'created_by' => Auth::user()->id,
            ]);
            $this->dispatch('audio-file-uploaded', name: $agentAudioFile->id);
        } else {
            $this->addError('audio_file', 'Something went wrong while uploading the file. Please try again.');
            return;
        }

        redirect()->route('call-center.manage-agent-audio');
    }
    public function render()
    {
        return view('livewire.call-center.add-agent-audio', [
            'agents' => User::where('job_description_id', 12)->get(),
        ]);
    }
}
