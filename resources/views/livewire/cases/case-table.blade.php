<section>
    <div class="flex flex-col w-full gap-5 overflow-x-auto">
        <table class="table w-full table-compact">
            <thead>
                <tr>
                    <th style="background-color: rgb(4 47 46);color:#fff;">Case Number</th>
                    <th style="background-color: rgb(4 47 46);color:#fff;">Company</th>
                    <th style="background-color: rgb(4 47 46);color:#fff;">Defendant</th>
                    <th style="background-color: rgb(4 47 46);color:#fff;">Type</th>
                    <th style="background-color: rgb(4 47 46);color:#fff;">Status</th>
                    <th style="background-color: rgb(4 47 46);color:#fff;">Court</th>
                    {{-- <th style="background-color: rgb(4 47 46);color:#fff;">Court Date</th> --}}
                    <th style="background-color: rgb(4 47 46);color:#fff;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ( $collections as $collection)
                <tr>
                    <th><span class="text-green-950">{{ $collection->case_number }}</span></th>
                    <th><span class="text-green-950">{{ $collection->client->client_company }}</span></th>
                    <th><span class="text-green-950">{{ $collection->case_defendant }}</span></th>
                    <th><span class="text-green-950">{{ $collection->case_type }}</span></th>
                    <td><span class="text-green-950">{{ $collection->case_status }}</span></td>
                    @php
                    $latestCourtDate = $collection->court->sortByDesc('court_date')->first();
                    @endphp
                    <td><span class="text-green-950">{{ $latestCourtDate->court_name }}</span></td>
                    {{-- <td>{{ $latestCourtDate->court_date }}</td> --}}
                    <td>
                        <button wire:click='summary({{ $collection->id }})' class="text-green-950" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                        |
                        <button class="text-green-950" type="button" wire:click='view({{ $collection->id }})'>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td>No list</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div>
            {{ $collections->links('pagination::tailwind') }}
        </div>
    </div>

    <x-modal name="view_details" :show="false">
        @if($data != null)
        <div class="bg-white p-6 max-h-[600px] overflow-y-scroll">
            <div class="block mb-3">
                <span class="font-bold">{{ $data->case_number }}</span>
            </div>
            <div class="flow-root rounded-lg border border-gray-100 py-3 shadow-sm">
                <div class="mb-3 px-3">
                    <span class="font-bold">Case</span>
                </div>
                <dl class="-my-3 divide-y divide-gray-100 text-sm">
                    <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Plaintiff</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $data->case_plaintiff }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Defendant</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $data->case_defendant }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Seet Relation</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $data->case_relation }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Type</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $data->case_type }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Description</dt>
                        <dd class="text-gray-700 sm:col-span-2">
                            {{ $data->case_description }}
                        </dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt class=" text-gray-900 text-base font-bold">Client</dt>
                        <dd class="text-gray-700 sm:col-span-2"></dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Company</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $data->client->client_company }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Representative</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $data->client->client_representative }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Email</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $data->client->client_email }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Mobile Number</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $data->client->client_mobile }}</dd>
                    </div>

                </dl>
            </div>
            <div class="my-3 px-3">
                <span class="font-bold">Court</span>
            </div>
            <div class="overflow-x-auto rounded-lg mt-2 border border-gray-200">
                <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th class="whitespace-nowrap text-left px-4 py-2 font-medium text-gray-900">Court</th>
                            <th class="whitespace-nowrap text-left px-4 py-2 font-medium text-gray-900">Address</th>
                            <th class="whitespace-nowrap text-left px-4 py-2 font-medium text-gray-900">Date</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        @forelse ($data->court as $court )
                            <tr>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $court->court_name }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $court->court_address }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $court->court_date }}</td>
                            </tr>

                        @empty
                        <tr>
                            <td colspan="12" class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">No dates for court.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </x-modal>


</section>
