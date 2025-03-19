<div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-black dark:text-gray-400">
            <tr>
                <th></th>
                @include('components.includes.table-sortable-th', [
                    'name' => 'name',
                    'displayName' => 'Name',
                ])
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3 w-1/9">
                    Role
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userList as $user)
                <tr
                    class="bg-white border-b dark:bg-black dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-900">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-700">
                                {{ strtoupper($user->initials()) }}
                            </div>
                        </div>
                    </td>
                    <th class="px-6 py-4">
                        {{ $user->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->roles ? implode(', ', $user->roles->pluck('name')->toArray()) : '' }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="inline-flex items-center space-x-2">
                            <flux:link href="{{ route('setting.edit-user', $user->id) }}" wire:navigate>
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
                            <flux:separator vertical />
                            <flux:link href="{{ route('setting.edit-user', $user->id) }}" wire:navigate>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="red" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </flux:link>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="p-4 bg-gray-50 dark:bg-black dark:text-white">
        {{ $userList->links() }}
    </div>
</div>
