<div class="p-6 text-teal-950">
    <div class="block mb-8">
        <h2 class="text-2xl font-bold">Client</h2>
        <small>{{ isset($case) ? "View or edit the information of the client":"Add the information of the client" }}</small>
    </div>
    <div class="grid grid-cols-3 gap-3 md:grid-cols-5">

        <div class="col-span-full md:col-span-3">
            <x-input-label for="client_company" :value="__('Name of the company/اسم الشركة')" />
            <x-text-input placeholder="" id="client_company" name="client_company" type="text" class="block w-full mt-1" :value="isset($case) ? $case->client->client_company : old('client_company')" autofocus required autocomplete="client_company" />
            <x-input-error class="mt-2" :messages="$errors->get('client_company')" />
        </div>

        <div class="col-span-full md:col-span-2">
            <x-input-label for="client_email" :value="__('Email/البريد الإلكتروني')" />
            <x-text-input id="client_email" name="client_email" type="email" class="block w-full mt-1" :value="isset($case) ? $case->client->client_email : old('client_email')" required autofocus autocomplete="client_contact" />
            <x-input-error class="mt-2" :messages="$errors->get('client_email')" />
        </div>

        <div class="col-span-full md:col-span-2">
            <x-input-label for="client_representative" :value="__('Representative/الممثل')" />
            <x-text-input id="client_representative" name="client_representative" type="text" class="block w-full mt-1" :value="isset($case) ? $case->client->client_representative : old('client_representative')" required autofocus autocomplete="client_representative" />
            <x-input-error class="mt-2" :messages="$errors->get('client_representative')" />
        </div>

        <div class="col-span-full md:col-span-2">
            <x-input-label for="client_mobile" :value="__('Mobile Number/ رقم الجوال')" />
            <x-text-input id="client_mobile" name="client_mobile" type="number" class="block w-full mt-1" :value="isset($case) ? $case->client->client_mobile : old('client_mobile')" required autofocus autocomplete="client_mobile" />
            <x-input-error class="mt-2" :messages="$errors->get('client_mobile')" />
        </div>






    </div>
</div>
