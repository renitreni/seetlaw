<x-app-layout>
    <x-slot name="title" > Create Case </x-slot>
    <x-slot name="header">
        <div  class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __("Create a new case") }}
            </h2>
           <div class="inline-flex items-center gap-2">
            <x-blade-button onclick="window.location.href='{{ route('case') }}'" class="hover:bg-teal-950/80 hover:border-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                  </svg>
                <span>Cancel</span>
            </x-blade-button >
           </div>
        </div>
        @include('alerts.alerts')
    </x-slot>

    <form enctype="multipart/form-data" action="{{ route('save_case') }}" method="POST" class="py-12">
        @csrf
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="space-y-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                @include('cases.partials.client-fields')
                @include('cases.partials.case-fields')
                @include('cases.partials.court-fields')

                <div class="flex justify-end p-7">
                    <x-blade-button class="hover:bg-teal-950/80" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                          </svg>
                        <span>Save and Submit</span>
                    </x-blade-button >
                </div>
            </div>

        </div>
    </form>
</x-app-layout>
