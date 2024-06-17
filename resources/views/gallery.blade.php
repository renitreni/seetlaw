<x-app-layout>
    <x-slot name="title" > Gallery | Seet Law </x-slot>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Gallery') }}
            </h2>
            <x-blade-button x-data x-on:click.prevent="$dispatch('open-modal', 'upload_gallery')" class="hover:bg-teal-950/80">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                <span>Upload Photo</span>
            </x-blade-button >
        </div>
        @include('alerts.alerts')
    </x-slot>

    <div class="max-w-[76rem] mx-auto mt-5">
        <livewire:gallery.gallery-cards />
    </div>

    @include('gallery.upload')

</x-app-layout>
