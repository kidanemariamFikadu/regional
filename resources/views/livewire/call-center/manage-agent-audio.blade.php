<div>

    @if (session('error'))
        <div id="alertBox" class="bg-red-400 border border-red-400 text-white px-4 py-3 rounded relative"
            role="alert">
            <strong class="font-bold">Error: </strong>
            <span class="block sm:inline">{{ session('error') }}</span>
            <span onclick="document.getElementById('alertBox').remove()"
                class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-white" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652A1 1 0 105.652 7.066L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z" />
                </svg>
            </span>
        </div>
    @endif
    @include('partials.head', ['title' => __('Agents List')])

    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">{{ __('Agents List') }}</h1>

        @if(Auth::user()->hasAnyRole(['Admin','Call center evaluator','Call center admin']))
            <flux:link href="{{ route('call-center.add-agent-audio') }}" wire:navigate>
                {{ __('Add Agent Audio') }}
            </flux:link>
        @endif
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
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
                    placeholder="Search for agent">
            </div>
            <div>
                @if(Auth::user()->hasAnyRole(['Admin','Call center admin']))
                <flux:button wire:click="closeMonth">{{ __('Close Month') }}</flux:button>
                @endif
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-black dark:text-gray-400">
                <tr>
                    <th>Agent Name</th>
                    <th scope="col" class="px-6 py-3 w-1/9">
                        Month
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Result
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Remark
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Files/Evaluated
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($agentsUnderEvaluation as $agentUnderEvaluation)
                    <tr
                        class="bg-white border-b dark:bg-black dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-900">
                        <td class="px-6 py-4">
                            {{ $agentUnderEvaluation->agent->name }}
                        </td>
                        <th class="px-6 py-4">
                            {{ $agentUnderEvaluation->month }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $agentUnderEvaluation->total_score ? $agentUnderEvaluation->total_score : 'Not Evaluated' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $agentUnderEvaluation->remarks }}
                        </td>
                        <td class="px-6 py-4">
                            {{ count($agentUnderEvaluation->filesPerMonth) }} /
                            {{ count($agentUnderEvaluation->fileEvaluatedPermonth) }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="inline-flex items-center space-x-2">
                                @if(Auth::user()->hasAnyRole(['Call center evaluator','Call center admin']))
                                    <flux:link href="{{ route('call-center.add-agent-audio', $agentUnderEvaluation->id) }}"
                                        wire:navigate>
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
                                    <flux:link
                                        href="{{ route('call-center.evaluate-agent-call', $agentUnderEvaluation->id) }}"
                                        wire:navigate>
                                        {{ __('Evaluate') }}
                                    </flux:link>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="p-4 bg-gray-50 dark:bg-black dark:text-white">
            {{ $agentsUnderEvaluation->links() }}
        </div>
    </div>
</div>
