<x-modal name="upload_gallery" :show="false" focusable>
    <div x-data="{
        rows:[],
        add(){
            this.rows.push({
                image_path:'',
                image_name:''
            })
        },
        remove(index){
            this.rows.splice(index,1)
        }
    }" x-init="add">

        <div class="flex items-center justify-between p-6 text-green-950">
            <div>
                <h2 class="text-2xl font-semibold">Upload to gallery</h2>
                <small><em>Max size of image is 1 MB.</em></small>
            </div>
            <div>
                <x-blade-button class="hover:bg-teal-950 hover:text-white" @click="add">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Add image</span>
                </x-blade-button>
            </div>
        </div>
        <form enctype="multipart/form-data" method="post" action="{{ route('upload_gallery') }}" class="p-6">
            @csrf
            <div class="flex w-full overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Photo Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(row,index) in rows" :key="index">
                            <tr>
                                <th>
                                    <x-text-input  x-bind:name="`rows[${index}][image_path]`" x-model="row.image_path" type="file"
                                    accept="image/*" class="w-full p-2 text-green-950 " autocomplete="image_path" />
                                    <x-input-error :messages="$errors->get('image_path')" class="mt-2" />
                                </th>
                                <td>
                                    <x-text-input x-bind:name="`rows[${index}][image_name]`" x-model="row.image_name" type="text"
                                        accept="image/*" class="block w-full text-green-950" autocomplete="image_name" />
                                    <x-input-error :messages="$errors->get('image_name')" class="mt-2" />
                                </td>
                                <td>
                                    <x-blade-button @click="remove(index)" class="hover:text-rose-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </x-blade-button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end mt-6">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button type="submit" class="space-x-2 text-white ms-3 bg-teal-950 hover:bg-teal-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m0-3-3-3m0 0-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75" />
                    </svg>
                    <span> {{ __('Upload') }}</span>
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
