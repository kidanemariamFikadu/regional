<section class="w-full">
    @include('partials.head', ['title' => __('Edit User')])

    <div class="flex items
    -center justify-between">
        <h1 class="text-2xl font-bold">{{ __('Edit User') }}</h1>

        <flux:link href="{{ route('setting.user-list') }}" wire:navigate>
            {{ __('Back') }}
        </flux:link>
    </div>

    <form wire:submit.prevent="editUser" class="my-6 w-full space-y-6">
        <flux:fieldset>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 gap-y-6">
                <div class="space-y-6 col-span-1">
                    <flux:input wire:model="name" label="{{ __('Name') }}" type="text" name="name" autofocus
                        badge="Required" />

                    <flux:input wire:model="email" label="{{ __('Email') }}" type="email" name="email"
                        badge="Required" />

                    <flux:input wire:model="phone_number" label="{{ __('Phone number') }}" type="tel"
                        name="phone_number" badge="Required" />

                    <flux:checkbox.group wire:model="role" label="Notifications">
                        @foreach ($roleList as $roles)
                            <flux:checkbox wire:click="updateRole('{{ $roles->name }}')" label="{{ $roles->name }}"
                                value="{{ $roles->name }}" />
                        @endforeach

                        @if (is_array($role) && in_array('Others', $role))
                            <flux:input wire:model="purposeOthers" label="Others" type="text" name="purposeOthers" />
                        @endif
                    </flux:checkbox.group>

                    <flux:select wire:model="regionalOfficeId" label="{{ __('Regional Office') }}"
                        name="regionalOfficeId" badge="Required">
                        <option value="">{{ __('Select Regional Office') }}</option>
                        @foreach ($regionalOffices as $regionalOffice)
                            <option value="{{ $regionalOffice->id }}">{{ $regionalOffice->name }}</option>
                        @endforeach
                    </flux:select>
        </flux:fieldset>
        <div class="flex items-center gap-4">
            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}
                </flux:button>
            </div>

            <x-action-message class="me-3" on="user-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>
