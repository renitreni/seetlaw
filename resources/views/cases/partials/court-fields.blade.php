<div class="p-6 text-teal-950">
    <div class="block mb-8">
        <h2 class="text-2xl font-bold">Court</h2>
        <small>Add the information about the court.</small>
    </div>
    <div class="grid grid-cols-3 gap-3 md:grid-cols-4">
        <div class="col-span-full md:col-span-2">
            <x-input-label for="court_name" :value="__('Court/اسم المحكمة')" />
            <x-text-input id="court_name" name="court_name" type="text" class="block w-full mt-1" :value="old('court_name')" required autofocus autocomplete="court_name" />
            <x-input-error class="mt-2" :messages="$errors->get('court_name')" />
        </div>

        <div class="col-span-full md:col-span-1">
            <x-input-label for="court_address" :value="__('Address/العنوان')" />
            <x-text-input id="court_address" name="court_address" type="text" class="block w-full mt-1" :value="old('court_address')" required autofocus autocomplete="court_address" />
            <x-input-error class="mt-2" :messages="$errors->get('court_address')" />
        </div>

        <div class="col-span-full md:col-span-1">
            <x-input-label for="court_date" :value="__('Date/تاريخ')" />
            <x-text-input id="court_date" name="court_date" type="date" class="block w-full mt-1" :value="old('court_date')" required autofocus autocomplete="court_date" />
            <x-input-error class="mt-2" :messages="$errors->get('court_date')" />
        </div>
    </div>
</div>
