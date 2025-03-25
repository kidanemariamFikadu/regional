<div>
    @include('partials.head', ['title' => __('Regional Office List')])

    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">{{ __('Regional Office List') }}</h1>

        <flux:modal.trigger name="create-regional-office">
            <flux:button class="mb-4">{{ __('Add Regional Office') }}</flux:button>
        </flux:modal.trigger>

    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
            <div>
                {{-- some dropdowns here        --}}
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div
                    class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="table-search" wire:model.live.debounce.300ms="search" name="search"
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for orders">
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-black dark:text-gray-400">
                <tr>
                    @include('components.includes.table-sortable-th', [
                        'name' => 'name',
                        'displayName' => 'Name',
                    ])
                    @include('components.includes.table-sortable-th', [
                        'name' => 'region',
                        'displayName' => 'Region',
                    ])
                    @include('components.includes.table-sortable-th', [
                        'name' => 'country',
                        'displayName' => 'Country',
                    ])
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($regionalOffices as $regionalOffice)
                    <tr
                        class="bg-white border-b dark:bg-black dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-900">
                        <th class="px-6 py-4">
                            {{ $regionalOffice->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $regionalOffice->region }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $regionalOffice->country }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="inline-flex items-center space-x-2">
                                <flux:link href="{{ route('setting.edit-regional-office', $regionalOffice->id) }}" wire:navigate>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-pencil-line  w-5 h-5">
                                        <path d="M12 20h9" />
                                        <path
                                            d="M16.376 3.622a1 1 0 0 1 3.002 3.002L7.368 18.635a2 2 0 0 1-.855.506l-2.872.838a.5.5 0 0 1-.62-.62l.838-2.872a2 2 0 0 1 .506-.854z" />
                                        <path d="m15 5 3 3" />
                                    </svg>
                                </flux:link>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="p-4 bg-gray-50 dark:bg-black dark:text-white">
            {{ $regionalOffices->links() }}
        </div>
    </div>

    <flux:modal name="create-regional-office" variant="flyout" wire:model.self="showCreateRegionalOfficeModal">
        <form wire:submit.prevent="saveRegionalOffice" class="my-6 w-full space-y-6">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Regional Office</flux:heading>
                    <flux:text class="mt-2">Add new regional office</flux:text>
                </div>

                <flux:input label="{{ __('Name') }}" placeholder="{{ __('Name') }}" wire:model="name" />

                <flux:input lable="{{ __('Region') }}" placeholder="{{ __('Region') }}" wire:model="region" />

                <flux:input lable="{{ __('Country') }}" placeholder="{{ __('Country') }}" wire:model="country" />

                <div class="flex">
                    <flux:spacer />

                    <flux:button type="submit" variant="primary">Save changes</flux:button>
                </div>
            </div>
        </form>
    </flux:modal>
</div>
