<div id="sidebar" class="w-auto bg-white h-screen rounded-none border-none transition-all duration-200 ease-in-out">
    <!-- Items -->
    <div class="p-2 space-y-3 pt-10">
        <!-- Dashboard -->
        <x-responsive-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <i class="fas fa-home text-lg"></i>
            <span class="font-medium">Dashboard</span>
        </x-responsive-sidebar-link>

        <x-responsive-sidebar-link :href="route('case')" :active="request()->routeIs('case')">
            <i class="fas fa-check-circle"></i>
            <span class="font-medium">Case</span>
        </x-responsive-sidebar-link>

        <x-responsive-sidebar-link :href="route('invoice')" :active="request()->routeIs('invoice')">
            <i class="fas fa-receipt"></i>
            <span class="font-medium ">Invoice</span>
        </x-responsive-sidebar-link>
    </div>
</div>