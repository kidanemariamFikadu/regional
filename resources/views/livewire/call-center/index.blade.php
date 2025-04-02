<div>
    <form wire:submit.prevent="uploadData" class="my-6 w-full space-y-6">
        <flux:fieldset>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 gap-y-6">
                <div class="space-y-6 col-span-1">
                    <flux:input type="file" wire:model="logo" wire:model="image" label="Logo" />
                </div>
            </div>
            {{ $image }}
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}
                    </flux:button>
                </div>

                <x-action-message class="me-3" on="user-updated">
                    {{ __('Saved.') }}
                </x-action-message>

                <div>
                    @if ($imageUrl)
                        <audio id="audioPlayer" controls>
                            <source src="{{ $imageUrl }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    @endif
                </div>
                {{ $imageUrl }}
            </div>
        </flux:fieldset>
    </form>
</div>
