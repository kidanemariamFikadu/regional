<th scope="col" class="px-6 py-3 items-center cursor-pointer" wire:click="setSortBy('{{ $name }}')">
    <div class="inline-flex items-center">
        <span>{{ $displayName }}</span>
        @if ($sortBy !== $name)
            <svg class="w-5 h-5 ml-2 text-gray-800 dark:text-white" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 20V10m0 10-3-3m3 3 3-3m5-10v10m0-10 3 3m-3-3-3 3" />
            </svg>
        @elseif($sortDir === 'asc')
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-arrow-down-narrow-wide w-5 h-5 ml-2 text-gray-800 dark:text-white">
                <path d="m3 16 4 4 4-4" />
                <path d="M7 20V4" />
                <path d="M11 4h4" />
                <path d="M11 8h7" />
                <path d="M11 12h10" />
            </svg>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-arrow-up-narrow-wide w-5 h-5 ml-2 text-gray-800 dark:text-white">
                <path d="m3 8 4-4 4 4" />
                <path d="M7 4v16" />
                <path d="M11 12h4" />
                <path d="M11 16h7" />
                <path d="M11 20h10" />
            </svg>
        @endif
    </div>
</th>