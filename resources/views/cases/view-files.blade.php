<x-app-layout>
    <x-slot name="title"> {{ $case->case_number }} | Case Record </x-slot>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex flex-col justify-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __($case->case_number) }}
                </h2>
                <x-blade-breadcrumbs first="Case Table" :firstLink="route('case')" :second="$case->case_number"
                    :secondLink="route('view_case',['id'=>$case->id])" third="Uploaded files" />
            </div>
            <div class="inline-flex items-center gap-2">

                <x-blade-button onclick="window.location.href='{{ route('case') }}'" class="hover:bg-teal-950/80">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                    <span>Back</span>
                </x-blade-button>
            </div>
        </div>
        @include('alerts.alerts')
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 space-y-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <section class="container px-4 mx-auto">
                    <div class="sm:flex sm:items-center sm:justify-between">
                        <h2 class="text-lg font-medium text-gray-800">Files uploaded</h2>

                        <div class="flex items-center mt-4 gap-x-3">

                            <x-blade-button x-data x-on:click.prevent="$dispatch('open-modal', 'upload_files')"
                                class="hover:bg-green-900 hover:border-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                                </svg>
                                <span>Upload new files</span>
                            </x-blade-button>
                        </div>
                    </div>

                    <div class="flex flex-col mt-6">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden border border-gray-200 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200 ">
                                        <thead class="bg-gray-50 ">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500">
                                                    <div class="flex items-center gap-x-3">
                                                        <span>File name</span>
                                                    </div>
                                                </th>

                                                <th scope="col"
                                                    class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">
                                                    File type
                                                </th>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">
                                                    Date uploaded
                                                </th>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">
                                                    Last updated
                                                </th>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">
                                                    Uploaded by
                                                </th>

                                                <th scope="col" class="relative py-3.5 px-4">
                                                    <span class="sr-only">Delete</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody
                                            class="bg-white divide-y divide-gray-200">
                                            @forelse ($files as $file )
                                            @php
                                            $split = explode(".",$file->case_filepath);
                                            @endphp
                                            <tr>
                                                <td
                                                    class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                    <div class="inline-flex items-center gap-x-3">
                                                        <div class="flex items-center gap-x-2">

                                                            <div
                                                                class="flex items-center justify-center w-8 h-8 text-blue-500 bg-blue-100 rounded-full ">
                                                                @if($split[1] == "png" || $split[1] == "jpeg" ||
                                                                $split[1] == "jpg")
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="w-5 h-5">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                                </svg>
                                                                @endif

                                                                @if($split[1] == "mp4" || $split[1] == "mkv")
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="w-5 h-5">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h1.5C5.496 19.5 6 18.996 6 18.375m-3.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-1.5A1.125 1.125 0 0118 18.375M20.625 4.5H3.375m17.25 0c.621 0 1.125.504 1.125 1.125M20.625 4.5h-1.5C18.504 4.5 18 5.004 18 5.625m3.75 0v1.5c0 .621-.504 1.125-1.125 1.125M3.375 4.5c-.621 0-1.125.504-1.125 1.125M3.375 4.5h1.5C5.496 4.5 6 5.004 6 5.625m-3.75 0v1.5c0 .621.504 1.125 1.125 1.125m0 0h1.5m-1.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m1.5-3.75C5.496 8.25 6 7.746 6 7.125v-1.5M4.875 8.25C5.496 8.25 6 8.754 6 9.375v1.5m0-5.25v5.25m0-5.25C6 5.004 6.504 4.5 7.125 4.5h9.75c.621 0 1.125.504 1.125 1.125m1.125 2.625h1.5m-1.5 0A1.125 1.125 0 0118 7.125v-1.5m1.125 2.625c-.621 0-1.125.504-1.125 1.125v1.5m2.625-2.625c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125M18 5.625v5.25M7.125 12h9.75m-9.75 0A1.125 1.125 0 016 10.875M7.125 12C6.504 12 6 12.504 6 13.125m0-2.25C6 11.496 5.496 12 4.875 12M18 10.875c0 .621-.504 1.125-1.125 1.125M18 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m-12 5.25v-5.25m0 5.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125m-12 0v-1.5c0-.621-.504-1.125-1.125-1.125M18 18.375v-5.25m0 5.25v-1.5c0-.621.504-1.125 1.125-1.125M18 13.125v1.5c0 .621.504 1.125 1.125 1.125M18 13.125c0-.621.504-1.125 1.125-1.125M6 13.125v1.5c0 .621-.504 1.125-1.125 1.125M6 13.125C6 12.504 5.496 12 4.875 12m-1.5 0h1.5m-1.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M19.125 12h1.5m0 0c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h1.5m14.25 0h1.5" />
                                                                </svg>
                                                                @endif

                                                                @if($split[1] == 'xls' || $split[1] == 'xlsx' ||
                                                                $split[1] == 'pdf' || $split[1] == 'pptx' || $split[1]
                                                                == 'ppt' || $split[1] == 'docx' || $split[1] == 'txt')
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="w-5 h-5">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                                                </svg>
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <h2 class="font-normal text-gray-800">
                                                                    <a target="_blank" href="{{ route('stream_case_files',['path'=>$file->case_filename.".".$split[1]]) }}">{{ ucwords($file->case_filename) }}</a></h2>
                                                                <p
                                                                    class="text-xs font-normal text-gray-500">
                                                                    {{ $split[1] }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td
                                                    class="px-12 py-4 text-sm font-normal text-gray-700 whitespace-nowrap">
                                                    {{ $split[1] }}
                                                </td>
                                                <td
                                                    class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                    {{ date('F d, Y',strtotime($file->created_at))}}</td>
                                                <td
                                                    class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                    {{ date('F d, Y',strtotime($file->updated_at ))}}</td>
                                                <td
                                                    class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                    {{ ucwords($file->case_fileuploader) }}</td>
                                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <div class="dropdown">
                                                        <label
                                                            class="px-1 py-1 text-gray-500 transition-colors duration-200 rounded-lg cursor-pointer hover:bg-gray-100"
                                                            tabindex="0">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                                            </svg>
                                                        </label>
                                                        <div class="dropdown-menu dropdown-menu-left">
                                                            <form action="{{ route('destroy_case_files',['file'=>$file]) }}" method="POST">
                                                                @csrf
                                                                @method("delete")
                                                                <button type="submit" tabindex="-1"
                                                                    class="text-sm hover:bg-rose-600/40 hover:text-white dropdown-item">Delete
                                                                </button>
                                                            </form>

                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>

                                            @empty
                                                <tr>
                                                    <td colspan="12"><small>No Files</small></td>
                                                </tr>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        {{ $files->links('pagination::tailwind') }}
                    </div>
                </section>
            </div>
        </div>
    </div>

    <x-modal name="upload_files" :show="false" focusable>
        <div>
            <div class="flex items-center justify-between p-6">
                <div>
                    <h2 class="text-2xl font-semibold">Upload New Documents</h2>
                    <small><em>Max size of image is 2 MB.</em></small>
                </div>
            </div>
            <form enctype="multipart/form-data" method="post"
                action="{{ route('upload_case_files',['id'=>$case->id]) }}" class="p-6">
                @csrf
                <div class="col-span-full md:col-span-2">
                    <input multiple name="case_files[]" type="file"
                        class="p-0.5 mt-1 border rounded-md shadow  file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-green-900 hover:file:bg-green-100 border-black/10">
                    <x-input-error class="mt-2" :messages="$errors->get('case_files')" />
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

</x-app-layout>
