<section class="w-full">
    @include('partials.head', ['title' => __('Evaluating Agent Call')])

    <div class="flex items
    -center justify-between">
        <h1 class="text-2xl font-bold">{{ __('Evaluating Agent Call') }}</h1>

        <flux:link href="{{ route('call-center.manage-agent-audio') }}" wire:navigate>
            {{ __('Back') }}
        </flux:link>
    </div>

    <form wire:submit.prevent="evaluationValue" class="my-6 w-full space-y-6">
        <flux:fieldset>
            <div class="lg:grid-cols-2 gap-x-4 gap-y-6">
                <div class="space-y-6 col-span-1">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                        <div class="md:col-span-2 col-span-1">
                            <flux:select wire:model="audioId" label="{{ __('Audio file') }}" name="audioId"
                                badge="Required" wire:change="onOptionSelected($event.target.value)">
                                <option value="">{{ __('Select Audio File') }}</option>
                                @foreach ($agentAudioFiles->filesPerMonth as $file)
                                    {{-- @if ($file->status == 'not_evaluated') --}}
                                        <option value="{{ $file->id }}">
                                            {{ $file->call_type . ' - (' . $file->status . ')' }}
                                        </option>
                                    {{-- @endif --}}
                                @endforeach
                            </flux:select>
                        </div>

                        <div class="md:col-span-1 col-span-1">
                            @if ($audioUrl)
                                <audio id="audioPlayer" controls class="w-full">
                                    <source src="{{ $audioUrl }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            @endif
                        </div>
                    </div>

                    @php
                        $categoryOrder = [
                            'Call Opening',
                            'Communication & Listening Skills',
                            'Issue Resolution',
                            'Professionalism & Courtesy',
                            'Call Closing',
                            'Compliance & Adherence',
                        ];
                    @endphp

                    @foreach ($categoryOrder as $category)
                        @if (isset($evaluationQuestions->groupBy('category')[$category]))
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <h2 class="text-lg font-semibold mb-2 md:col-span-2">{{ $category }}</h2>
                                @foreach ($evaluationQuestions->groupBy('category')[$category] as $evaluationQuestion)
                                    <div class="w-full max-w-md mx-auto flex flex-col gap-1">
                                        <div class="flex items-center justify-between mb-1">
                                            <label for="slider{{ $evaluationQuestion->id }}"
                                                class="text-sm font-medium text-gray-700 dark:text-white">
                                                {{ $evaluationQuestion->Question }}
                                                <span
                                                    class="ml-1.5 text-zinc-800/70 text-xs bg-zinc-800/5 px-1.5 py-0.5 rounded-[4px] dark:bg-white/10 dark:text-white">
                                                    Required
                                                </span>
                                            </label>
                                        </div>

                                        <div class="flex items-center gap-4">
                                            <input id="slider{{ $evaluationQuestion->id }}" type="range"
                                                min="0" max="{{ $evaluationQuestion->value }}"
                                                class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer accent-blue-600 dark:accent-blue-400"
                                                wire:model="responses.{{ $evaluationQuestion->id }}"
                                                oninput="document.getElementById('sliderValue{{ $evaluationQuestion->id }}').textContent = this.value" />
                                            <span id="sliderValue{{ $evaluationQuestion->id }}"
                                                class="text-sm text-gray-800 dark:text-white font-medium">
                                                {{ $responses[$evaluationQuestion->id] ?? 0 }}
                                            </span>
                                        </div>
                                        @error("responses.$evaluationQuestion->id")
                                            <span class="text-red-400 mt-3 block ">
                                                <svg class="shrink-0 [:where(&amp;)]:size-5 inline" data-flux-icon=""
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true" data-slot="icon">
                                                    <path fill-rule="evenodd"
                                                        d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495ZM10 5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 5Zm0 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $message }}</span>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-1">
                            <flux:textarea wire:model="remark" label="{{ __('Remark') }}" name="remark"
                                placeholder="{{ __('Remark') }}" rows="3" />
                        </div>
                    </div>
                </div>
            </div>
        </flux:fieldset>
        <div class="flex items-center gap-4">
            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}
                </flux:button>
            </div>

            <x-action-message class="me-3" on="Audio-Evaluated">
                {{ __('Audio Evaluated.') }}
            </x-action-message>
        </div>
    </form>
</section>
