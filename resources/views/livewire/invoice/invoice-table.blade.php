<div class="flex w-full overflow-x-auto">
    <div class="flex flex-col w-full gap-6 ">
        <table class="table w-full table-compact">
            <thead>
                <tr>
                    <th style="background-color: rgb(4 47 46);color:#fff;">Invoice Number</th>
                    <th style="background-color: rgb(4 47 46);color:#fff;">Customer</th>
                    <th style="background-color: rgb(4 47 46);color:#fff;">Amount (SAR)</th>
                    <th style="background-color: rgb(4 47 46);color:#fff;">Date</th>
                    <th style="background-color: rgb(4 47 46);color:#fff;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ( $collection as $data_collect)
                <tr wire:key='{{ $data_collect->id }}'>
                    <th><span class="text-green-950">{{ $data_collect->invoice_number }}</span></th>
                    <td><span class="text-green-950">{{ $data_collect->customer_name }}</span></td>
                    <td><span class="text-green-950">{{ $data_collect->total_amount }}</span></td>
                    <td><span class="text-green-950">{{ date("F d, Y",strtotime($data_collect->created_at ))}}</span></td>
                    <td class="space-x-4">
                        <button class="text-green-950" wire:click='populateModal({{ $data_collect->id }})' x-data
                            x-on:click="$dispatch('open-modal','view-invoice')" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>

                        <button class="text-green-950" type="button" wire:click='download({{ $data_collect->id }})'>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m9 14.25 6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0c1.1.128 1.907 1.077 1.907 2.185ZM9.75 9h.008v.008H9.75V9Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm4.125 4.5h.008v.008h-.008V13.5Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </button>

                        <button class="text-green-950" type="button" x-data x-on:click="$dispatch('open-modal','delete-confirm-invoice')"
                            wire:click='deleteConfirm({{ $data_collect }})'>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
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
            {{ $collection->links('pagination::tailwind') }}
        </div>
    </div>


    <x-modal name="view-invoice" :show="false">
        @isset($data)
        <div class="p-6">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold uppercase">{{ __('Invoice') }}</h2>
                <span class="text-xs">{{ $data->invoice_number }}</span>
            </div>
            <div class="divider"></div>
            <div class="grid grid-cols-2 uppercase">
                <div>
                    <h2>{{ __('Company') }}</h2>
                    <div class="mt-5 space-y-3 text-xs">
                        <p class="flex items-center gap-1 font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                            </svg>
                            <span>Seet Law</span>
                        </p>
                        <p class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>

                            <span>Olaya St, Al Olaya, Riyadh 12253, Saudi Arabia</span>
                        </p>
                        <p class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                            </svg>

                            <span>+966112777668</span>
                        </p>
                        <p class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>

                            <span>info@seetlaw.sa</span>
                        </p>
                    </div>
                </div>
                <div>
                    <h2>{{ __('Customer') }}</h2>
                    <div class="mt-5 space-y-3 text-xs">
                        <p class="flex items-center gap-1 font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>

                            <span>{{ $data->customer_name }}</span>
                        </p>
                        <p class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>

                            <span>{{ $data->customer_address }}</span>
                        </p>
                        <p class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                            </svg>

                            <span>{{ $data->customer_phone }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto mt-7">
                <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">Service</th>
                            <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">Amount (SAR)
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @forelse ($data->services as $service )
                        <tr>
                            <td class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">{{
                                $service->service_name }}</td>
                            <td class="px-4 py-2 text-left text-gray-700 whitespace-nowrap">{{ $service->service_amount
                                }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12">{{ __('No list') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-4 mt-6 ">
                    <div>
                        <small>Sub Total : </small>
                        <small> SAR {{ $data->sub_total }}</small>
                    </div>
                    <div>
                        <small>VAT : </small>
                        <small> 15% </small>
                    </div>
                    <div>
                        <small>Total Amount : </small>
                        <small> SAR {{ $data->total_amount }}</small>
                    </div>
                </div>
                <br>
                <div class="divider"></div>
                <div>
                    <small> {{ date('F d, Y',strtotime($data->created_at)) }} </small>
                </div>
            </div>
        </div>
        @endisset
    </x-modal>


    <x-modal name="delete-confirm-invoice" maxWidth="sm" :show="false">
        @isset($data)
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Confirm Delete') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __("Are you sure to delete $data->invoice_number?") }}
            </p>
            <div class="flex justify-end mt-6">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button wire:click='delete({{ $data }})' class="ms-3">
                    {{ __('Delete') }}
                </x-danger-button>
            </div>
        </div>
        @endisset
    </x-modal>
</div>
