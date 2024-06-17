<div>
    <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
        @forelse ($cards as $card )
        <div class="relative block bg-black shadow group">
            <img
              alt=""
              src="{{ asset('storage/gallery/'.$card->image_path) }}"
              class="absolute inset-0 object-cover w-full h-full transition-opacity opacity-75 group-hover:opacity-50"
            />

            <div class="relative p-4 sm:p-6 lg:p-8">
              <button x-data x-on:click="$dispatch('open-modal','delete-photo')"  class="badge badge-error">Delete</button>
              <div class="mt-32 sm:mt-48 lg:mt-64">
                <div
                  class="transition-all transform translate-y-8 opacity-0 group-hover:translate-y-0 group-hover:opacity-100"
                >
                <p class="flex flex-col p-3 text-white rounded shadow shadow-white bg-teal-950">
                    <small>Name: {{ $card->image_name }}</small>
                    <small>Uploader: {{ $card->image_uploader }}</small>
                    <small>Uploaded Date: {{ date('F d, Y',strtotime($card->created_at)) }}</small>
                </p>
                </div>
              </div>
            </div>
        </div>
        @empty
            <div class="flex items-center justify-center col-span-full">
                <img class="size-[55%]" src="{{ asset('no image.svg') }}" alt="no-image">
            </div>
        @endforelse
    </div>
    <div class="divider"></div>
    <div class="mt-6">
        {{ $cards->links('pagination::tailwind') }}
    </div>

    @isset($card)
    <x-modal name="delete-photo" maxWidth="sm" :show="false">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Confirm Delete') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Are you sure to delete this photo?') }}
            </p>
            <div class="flex justify-end mt-6">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button wire:click='delete({{ $card->id }})'  class="ms-3">
                    {{ __('Delete') }}
                </x-danger-button>
            </div>
        </div>
    </x-modal>
    @endisset
</div>
