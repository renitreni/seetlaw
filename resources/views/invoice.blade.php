<x-app-layout>
    <x-slot name="title" > Invoice | Seet Law </x-slot>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Invoice') }}
            </h2>
            <x-blade-button class="hover:bg-teal-950/80" x-data x-on:click="$dispatch('open-modal','create-invoice')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                  </svg>
                <span>Create Invoice</span>
            </x-blade-button >
        </div>
        @include('alerts.alerts')
    </x-slot>

    <livewire:invoice.modal/>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <livewire:invoice.invoice-table/>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
