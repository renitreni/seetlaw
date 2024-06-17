<div class="p-6 text-teal-950">
    <div class="block mb-8">
        <h2 class="text-2xl font-bold">Case</h2>
        <small>{{ isset($case) ? "View or edit the information of the current case.":"Add the information of the current
            case." }}</small>
    </div>
    <div class="grid grid-cols-3 gap-3 md:grid-cols-6">
        <div class="col-span-full md:col-span-2">
            <x-input-label for="case_plaintiff" :value="__('Plaintiff/المدعي')" />
            <x-text-input id="case_plaintiff" name="case_plaintiff" type="text" class="block w-full mt-1"
                :value=" isset($case) ? $case->case_plaintiff : old('case_plaintiff')" required autofocus
                autocomplete="case_plaintiff" />
            <x-input-error class="mt-2" :messages="$errors->get('case_plaintiff')" />
        </div>

        <div class="col-span-full md:col-span-2">
            <x-input-label for="case_defendant" :value="__('Defendant/المدعى عليه')" />
            <x-text-input id="case_defendant" name="case_defendant" type="text" class="block w-full mt-1"
                :value=" isset($case) ? $case->case_defendant : old('case_defendant')" required autofocus
                autocomplete="case_defendant" />
            <x-input-error class="mt-2" :messages="$errors->get('case_defendant')" />
        </div>

        <div class="col-span-full md:col-span-1">
            <x-input-label for="case_relation" :value="__('Seet Relation/علاقة السيت')" />
            <x-text-input list="relationList" id="case_relation" name="case_relation" type="text"
                class="block w-full mt-1" :value=" isset($case) ? $case->case_relation : old('case_relation')" required
                autofocus autocomplete="case_relation" />
            <x-input-error class="mt-2" :messages="$errors->get('case_relation')" />
            <datalist id="relationList">
                <option value="Ismail Al Ismail"></option>
                <option value="Saleh Al Atram"></option>
            </datalist>
        </div>


        <div class="col-span-full md:col-span-1">
            <x-input-label for="case_status" :value="__('Status/الحالة')" />
            <x-text-input list="statusList" id="case_status" name="case_status" type="text" class="block w-full mt-1"
                :value=" isset($case) ? $case->case_status : old('case_status')" required autofocus
                autocomplete="case_status" />
            <x-input-error class="mt-2" :messages="$errors->get('case_status')" />
            <datalist id="statusList">
                <option value="New"></option>
                <option value="Hold"></option>
                <option value="Ongoing"></option>
                <option value="Cancel"></option>
            </datalist>
        </div>

        <div class="col-span-full md:col-span-3">
            <x-input-label for="case_type" :value="__('Type/النوع')" />
            <x-text-input list="typeList" id="case_type" name="case_type" type="text" class="block w-full mt-1"
                :value=" isset($case) ? $case->case_type : old('case_type')" required autofocus
                autocomplete="case_type" />
            <x-input-error class="mt-2" :messages="$errors->get('case_type')" />
            <datalist id="typeList">
                <option value="Litigation and pleading">الدعاوى والتقادم</option>
                <option value="General Legal Consultation">الاستشارة القانونية العامة</option>
                <option value="Legal consultations in the financial and business sector">الاستشارات القانونية في القطاع المالي والأعمال</option>
                <option value="Contract Services">خدمات العقود</option>
                <option value="Liquidation of Companies">تصفية الشركات</option>
                <option value="Liquidation of estates">تصفية الأملاك</option>
                <option value="Legal mediation and arbitration">الوساطة القانونية والتحكيم</option>
                <option value="Intellectual Property">الملكية الفكرية</option>
                <option value="Establishing Companies">تأسيس الشركات</option>
                <option value="Creating legal department and divisions">إنشاء الإدارة القانونية والأقسام</option>
                <option value="Dept Collection">تحصيل الديون</option>
                <option value="Governance Service">خدمات الحوكمة</option>
                <option value="Other">أخرى</option>

            </datalist>
        </div>

        <div class="col-span-full md:col-span-1">
            <x-input-label for="case_date" :value="__('Date/تاريخ')" />
            <x-text-input id="case_date" name="case_date" type="date" class="block w-full mt-1"
                :value=" isset($case) ? $case->case_date : old('case_date')" required autofocus
                autocomplete="case_date" />
            <x-input-error class="mt-2" :messages="$errors->get('case_date')" />
        </div>


        <div class="col-span-full md:col-span-2">
            <x-input-label for="case_docsready" :value="__('Document Ready/الوثيقة جاهزة')" />
            <div
                class="gap-1 mt-1.5 tabs border border-gray-300 focus:border-teal-950 focus:ring-teal-950 rounded-md shadow-sm">
                @if (isset($case))
                <input {{ $case->case_docsready == "Ready" ? "checked":"" }} type="radio" id="ready" value="Ready"
                name="case_docsready" class="tab-toggle" />
                <label for="ready" class=" tab tab-pill">{{ __('Ready') }}</label>

                <input {{ $case->case_docsready == "No" ? "checked":"" }} type="radio" id="notyet" value="No"
                name="case_docsready" class="tab-toggle"/>
                <label for="notyet" class=" tab tab-pill">{{ __('Not Yet') }}</label>
                @else
                <input {{ old('case_docsready')=="Ready" ? "checked" :"" }} type="radio" id="ready" value="Ready"
                    name="case_docsready" class="tab-toggle" />
                <label for="ready" class=" tab tab-pill">{{ __('Ready') }}</label>

                <input {{ old('case_docsready')=="No" ? "checked" :"" }} type="radio" id="notyet" value="No"
                    name="case_docsready" class="tab-toggle" />
                <label for="notyet" class=" tab tab-pill">{{ __('Not Yet') }}</label>
                @endif

            </div>
            <x-input-error class="mt-2" :messages="$errors->get('case_defendant')" />
        </div>

        @if (!isset($case))
        <div class="col-span-full md:col-span-2">
            <x-input-label for="case_files" :value="__('Upload Documents/تحميل الوثائق')" />
            <input multiple name="case_files[]" type="file" class="p-0.5 mt-1 border rounded-md shadow  file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-green-900 hover:file:bg-green-100 border-black/10">
            <x-input-error class="mt-2" :messages="$errors->get('case_files')" />
        </div>
        @endif

        <div class="mt-4 col-span-full">
            <x-input-label for="case_description" :value="__('Description/الوصف')" />
            <textarea id="case_description" name="case_description" autofocus
                class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950"
                rows="4">{{ isset($case) ? $case->case_description : old('case_description') }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('case_description')" />
        </div>
    </div>
</div>
