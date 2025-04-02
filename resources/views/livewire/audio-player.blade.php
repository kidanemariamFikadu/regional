<div>
    @if ($audioUrl)
        <audio id="audioPlayer" controls>
            <source src="{{ $audioUrl }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    @endif

    <button wire:click="loadAudio" class="bg-blue-500 text-white px-4 py-2 rounded">
        Load Audio
    </button>
</div>
