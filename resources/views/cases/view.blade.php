<x-app-layout>
    <x-slot name="title"> {{ $case->case_number }} | Case Record </x-slot>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex flex-col">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __($case->case_number) }}
                </h2>
                <x-blade-breadcrumbs
                    first="Case Table"
                    :firstLink="route('case')"
                    :second="$case->case_number"
                />
            </div>
            <div class="inline-flex items-center gap-2">

                <x-blade-button x-data x-on:click.prevent="$dispatch('open-modal', 'confirm-case-deletion')"
                    class="hover:bg-rose-500 hover:border-rose-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                    <span>Delete</span>
                </x-blade-button>

                <x-blade-button
                    onclick="window.location.href='{{ route('view_case_files',['id'=>$case->id,'case_number'=>$case->case_number]) }}'"
                    class="hover:bg-green-900 hover:border-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                    </svg>

                    <span>Uploaded Files</span>
                </x-blade-button>

                <x-blade-button onclick="window.location.href='{{ route('case') }}'" class="hover:bg-teal-950/80">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                    <span>Back</span>
                </x-blade-button>
            </div>
        </div>
        @include('alerts.alerts')
    </x-slot>

    <form action="{{ route('update_case',['case'=>$case]) }}" method="POST" class="py-12">
        @csrf
        @method("PATCH")
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="space-y-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                @include('cases.partials.client-fields')
                @include('cases.partials.case-fields')
                <div class="p-6 text-teal-950">
                    <div class="flex items-center justify-between">
                        <div class="block mb-8">
                            <h2 class="text-2xl font-bold">Court</h2>
                            <small>Add or edit information for the court.</small>
                        </div>
                        <x-blade-button x-data x-on:click.prevent="$dispatch('open-modal', 'add-new-court')"
                            type="button" class="hover:bg-teal-950">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                            </svg>
                            <span>Add Court</span>
                        </x-blade-button>
                    </div>
                    <div class="flex w-full overflow-x-auto">
                        <table class="table w-full table-compact">
                            <thead>
                                <tr>
                                    <th>Court</th>
                                    <th>Address</th>
                                    <th>Date</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ( $case->court as $index => $court )
                                <tr>
                                    <th>
                                        <x-text-input name="courts[{{ $index }}][row_id]" type="hidden"
                                            class="block w-full mt-1 text-green-950"
                                            :value="isset($case) ? $court->id  : old('row_id')" required autofocus
                                            autocomplete="row_id" />
                                        <x-text-input name="courts[{{ $index }}][court_name]" type="text"
                                            class="block w-full mt-1 text-green-950"
                                            :value="isset($case) ? $court->court_name  : old('court_name')" required
                                            autofocus autocomplete="court_name" />
                                        <x-input-error class="mt-2"
                                            :messages="$errors->get('courts[{{ $index }}][court_name]')" />
                                    </th>
                                    <td>
                                        <x-text-input name="courts[{{ $index }}][court_address]" type="text"
                                            class="block w-full mt-1 text-green-950"
                                            :value="isset($case) ? $court->court_address  : old('court_address')"
                                            required autofocus autocomplete="court_address" />
                                        <x-input-error class="mt-2"
                                            :messages="$errors->get('courts[{{ $index }}][court_address]')" />
                                    </td>
                                    <td>
                                        <x-text-input name="courts[{{ $index }}][court_date]" type="date"
                                            class="block w-full mt-1 text-green-950"
                                            :value="isset($case) ? $court->court_date :  old('court_date')" required
                                            autofocus autocomplete="court_date" />
                                        <x-input-error class="mt-2"
                                            :messages="$errors->get('courts[{{ $index }}][court_date]')" />
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td>No registered Courts</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex justify-end p-7">
                    <x-blade-button type="submit" class="hover:bg-teal-950/80">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                        </svg>
                        <span>Save Changes</span>
                    </x-blade-button>
                </div>
            </div>
        </div>
    </form>

    <x-modal name="confirm-case-deletion" :show="false" focusable>
        <form method="post" action="{{ route('delete_case',['case'=>$case]) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete this case?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once this case is deleted, all of its resources and data will be permanently deleted.') }}
            </p>
            <div class="flex justify-end mt-6">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Case') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>

    <x-modal maxWidth="4xl" name="add-new-court" :show="false" focusable>
        <form method="post" action="{{ route('add_court',['case'=>$case]) }}" class="w-full p-6">
            @csrf
            <div class="w-full">
                @include('cases.partials.court-fields')
            </div>

            <div class="flex justify-end mt-6">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button type="submit" class="space-x-2 text-white ms-3 bg-teal-950 hover:bg-teal-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                    </svg>
                    <span> {{ __('Add Court') }}</span>
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
