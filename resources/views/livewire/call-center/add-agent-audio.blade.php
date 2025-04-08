<section class="w-full">
    @include('partials.head', ['title' => __('Create User')])

    <div class="flex items
    -center justify-between">
        <h1 class="text-2xl font-bold">{{ __('Create User') }}</h1>

        <flux:link href="{{ route('call-center.manage-agent-audio') }}" wire:navigate>
            {{ __('Back') }}
        </flux:link>
    </div>

    <form wire:submit.prevent="saveAgentAudio" class="my-6 w-full space-y-6">
        <flux:fieldset>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 gap-y-6">
                <div class="space-y-6 col-span-1">
                    <flux:select wire:model="agent_id" label="{{ __('Agent') }}"
                        name="agent_id" badge="Required">
                        <option value="">{{ __('Select Agent') }}</option>
                        @foreach ($agents as $agent)
                            <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                        @endforeach
                    </flux:select>

                    <flux:select wire:model="call_type" label="{{ __('Call Type') }}"
                        name="call_type" badge="Required">
                        <option value="">{{ __('Select Call Type') }}</option>
                        <option value="Inbound Bellow ACT">{{ __('Inbound Bellow ACT') }}</option>
                        <option value="Inbound Above ACT">{{ __('Inbound Above ACT') }}</option>
                        <option value="Outbound Bellow ACT">{{ __('Outbound Bellow ACT') }}</option>
                        <option value="Outbound Above ACT">{{ __('Outbound Above ACT') }}</option>
                    </flux:select>

                    <flux:input type="file" name="audio_file" wire:model="audio_file" label="Audio file" accept="audio/mp3,audio/*" />

        </flux:fieldset>
        <div class="flex items-center gap-4">
            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}
                </flux:button>
            </div>

            <x-action-message class="me-3" on="audio-file-uploaded">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>