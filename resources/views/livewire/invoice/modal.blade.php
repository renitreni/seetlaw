<x-modal name="create-invoice" :show="false" focusable>
    <div class="p-6 text-teal-950">
        <div>
            <h2 class="text-lg">Create new invoice</h2>
            <small><em>All fields are required.</em></small>
        </div>
        @include('alerts.alerts')

        <form wire:submit='create' class="grid grid-cols-1 gap-2 mt-4 md:grid-cols-4">
            <div class="col-span-2">
                <x-input-label for="customer_name" :value="__('Name')" />
                <x-text-input id="customer_name" wire:model.blur='customer_name' type="text" class="block w-full mt-1"
                    :value=" old('customer_name')" required autofocus autocomplete="customer_name" />
                <x-input-error class="mt-2" :messages="$errors->get('customer_name')" />
            </div>

            <div class="col-span-2">
                <x-input-label for="customer_phone" :value="__('Phone Number')" />
                <x-text-input id="customer_phone" wire:model.blur='customer_phone' type="number" class="block w-full mt-1"
                    :value=" old('customer_phone')" required autofocus autocomplete="customer_phone" />
                <x-input-error class="mt-2" :messages="$errors->get('customer_phone')" />
            </div>

            <div class="col-span-full">
                <x-input-label for="customer_address" :value="__('Address')" />
                <x-text-input id="customer_address" wire:model.blur='customer_address' type="text" class="block w-full mt-1"
                    :value=" old('customer_address')" required autofocus autocomplete="customer_address" />
                <x-input-error class="mt-2" :messages="$errors->get('customer_address')" />
            </div>

            <div class="flex w-full mt-6 overflow-x-auto col-span-full">
                <table class="table w-full table-compact">
                    <thead>
                        <tr>
                            <th style="background-color: rgb(4 47 46);color:#fff;">Service</th>
                            <th style="background-color: rgb(4 47 46);color:#fff;">Amount (SAR)</th>
                            <th style="background-color: rgb(4 47 46);color:#fff;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $services as $index => $service)
                        <tr>
                            <th>
                                <x-text-input wire:model='services.{{ $index }}.service_name' type="text"
                                    class="block w-full mt-1"
                                    required autofocus />
                            </th>
                            <td>
                                <x-text-input min="0" step="0.01" wire:model.live.debounce.300='services.{{ $index }}.service_amount' type="number"
                                    class="block w-full mt-1"
                                    required autofocus/>
                            </td>
                            <td>
                                <button type="button" wire:click='removeService({{ $index }})'>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                      </svg>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12">Add service</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="col-span-2 max-w-[80%] {{ !empty($services) ? "block":"hidden" }}">
                <div class="flex items-center justify-between text-sm">
                    <span>Sub Total (SAR):</span>
                    <span>{{ $sub_total }}</span>
                </div class="flex items-center justify-between text-sm">

                <div class="flex items-center justify-between text-sm">
                    <span>VAT:</span>
                    <span>15%</span>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <span>Total (SAR):</span>
                    <span>{{ $total_amount }}</span>
                </div>
            </div>


            <div class="flex items-center justify-end mt-5 col-span-full">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button x-on:click="$dispatch('addService')" type="button" class="space-x-2 text-white bg-teal-700 ms-3 hover:bg-teal-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>

                    <span> {{ __('Add Service') }}</span>
                </x-primary-button>

                <x-primary-button type="submit" class="space-x-2 text-white ms-3 bg-teal-950 hover:bg-teal-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m9 14.25 6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0c1.1.128 1.907 1.077 1.907 2.185ZM9.75 9h.008v.008H9.75V9Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm4.125 4.5h.008v.008h-.008V13.5Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>

                    <span> {{ __('Create') }}</span>
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
