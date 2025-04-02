<section class="w-full">
    @include('partials.head', ['title' => __('Create Evaluation Question')])

    <div class="flex items
    -center justify-between">
        <h1 class="text-2xl font-bold">{{ __('Create Evaluation Question') }}</h1>

        <flux:link href="{{ route('call-center.evaluation') }}" wire:navigate>
            {{ __('Back') }}
        </flux:link>
    </div>

    <form wire:submit.prevent="saveQuestion" class="my-6 w-full space-y-6">
        <flux:fieldset>
            <flux:heading class="flex items-center gap-2">
                Total Value Upto now: {{ $totalEvaluatioValue }}

                <flux:tooltip toggleable>
                    <flux:button icon="information-circle" size="sm" variant="ghost" />

                    <flux:tooltip.content class="max-w-[20rem] space-y-2">
                        <p>The total value of all evaluation questions should not exceed 100.
                        </p>
                        <p>Please ensure the sum of all question values remains within the limit.</p>
                        @if ($totalEvaluatioValue > 100)
                            <p class="text-red-500">Total value exceeds 100. Please adjust question values.</p>
                        @endif
                    </flux:tooltip.content>
                </flux:tooltip>
            </flux:heading>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 gap-y-6">
                <div class="space-y-6 col-span-1">
                    <flux:textarea wire:model="question" label="{{ __('Question') }}" type="text" name="question"
                        badge="Required" />
                    <flux:input wire:model="value" label="{{ __('Value') }}" type="number" name="value"
                        badge="Required" />
                    <flux:select wire:model="category" label="{{ __('Category') }}" name="category" badge="Required">
                        <option value="">{{ __('Select Category') }}</option>
                        <option value="Call Opening">Call Opening</option>
                        <option value="Communication & Listening Skills">Communication & Listening Skills</option>
                        <option value="Issue Resolution">Issue Resolution</option>
                        <option value="Professionalism & Courtesy">Professionalism & Courtesy</option>
                        <option value="Call Closing">Call Closing</option>
                        <option value="Compliance & Adherence">Compliance & Adherence</option>
                    </flux:select>
                    @if ($id)
                        <flux:radio.group wire:model="status" label="Select your payment method">
                            <flux:radio value="active" label="Active" />
                            <flux:radio value="inactive" label="In Active" />
                        </flux:radio.group>
                    @endif
                </div>
            </div>

        </flux:fieldset>
        <div class="flex items-center gap-4">
            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}
                </flux:button>
            </div>

            <x-action-message class="me-3" on="question-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>
