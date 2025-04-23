<div>
    @include('partials.head', ['title' => __('Role Management')])

    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">{{ __('Role Management') }}</h1>

        {{-- <flux:link href="{{ route('setting.create-user') }}" wire:navigate>
            {{ __('Create Job Description') }}
        </flux:link> --}}
    </div>

    <div>
        <form wire:submit.prevent="savePermission" class="my-6 w-full space-y-6">
            <flux:fieldset>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 gap-y-6">
                    <div class="space-y-6 col-span-1">
                        <flux:select wire:model="selectedRole" wire:change="onOptionSelected($event.target.value)"
                            label="{{ __('Role') }}" name="selectedRole" badge="Required">
                            <option value="">{{ __('Select role') }}</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </flux:select>
                        @if ($isLoading)
                            <div class="text-green-500">Loading...</div>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-x-4 gap-y-6">
                    <div class="col-span-3">
                        <label
                            class="block font-medium text-sm text-gray-700 dark:text-white mt-4">{{ __('Permissions') }}</label>
                    </div>
                    @foreach ($permissions->chunk(3) as $permissionChunk)
                        <div class="col-span-3 grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-6">
                            @foreach ($permissionChunk as $permission)
                                <div class="space-y-6 col-span-1">
                                    <flux:checkbox wire:model="selectedPermissions" label="{{ $permission->name }}"
                                        name="selectedPermissions" value="{{ $permission->name }}" />
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </flux:fieldset>
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}
                    </flux:button>
                </div>

                <x-action-message class="me-3" on="job-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>
    </div>
</div>
