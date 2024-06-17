<x-app-layout>
    <x-slot name="title" > Dashboard | Seet Law </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-3 max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between p-6 text-gray-900">
                    <div>
                        Welcome back , {{ Auth::user()->name }}
                    </div>
                    <div class="flex items-center justify-around gap-x-6">
                        <div>
                            <span class="text-sm">Total Case:</span>
                            <span class="font-bold">{{ $totalCase }}</span>
                        </div>

                        <div>
                            <span class="text-sm">Total Photos:</span>
                            <span class="font-bold">{{ $totalPhotos }}</span>
                        </div>

                        <div>
                            <span class="text-sm">Total Invoices:</span>
                            <span class="font-bold">{{ $totalInvoice }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                <div class="p-6 bg-white rounded shadow">
                    {!! $chart->container() !!}
                </div>
                <div class="p-6 space-y-3 bg-white rounded shadow">
                    <div class="text-green-950">
                        <p class="mb-2 text-sm font-bold">Upcoming schedule</p>
                        <small>These are the upcoming scheduled court dates.</small>
                    </div>
                    <div class="relative text-sm text-green-950 ">
                        <div class="max-h-[420px]  space-y-1.5 overflow-y-scroll">
                            @isset($scheds)
                                @forelse ( $scheds as $case )
                                    @isset($case->case)
                                        <x-blade-card-schedule :number="$case->case->case_number" :day="$case->case->case_date"
                                        :type="$case->case->case_type" />
                                    @endisset
                                @empty
                                <p class="text-green-900">No upcoming schedules.</p>
                                @endforelse
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @push("scripts")
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
    @endpush

</x-app-layout>
