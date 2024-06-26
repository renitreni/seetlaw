<?php

namespace App\Livewire\Gallery;

use App\Models\Gallery;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class GalleryCards extends Component
{
    public function delete(Gallery $gallery)
    {
        try {
            $filename = $gallery->image_path;
            Storage::delete('gallery/'.$filename);
            $gallery->delete();
            session()->flash('success', 'Image deleted successfully.');

            return $this->redirect(route('gallery'), navigate: true);
        } catch (Exception $exception) {

            Log::error('Error deleting image', [
                'msg' => $exception->getMessage(),
            ]);
            session()->flash('failed', 'Error deleting image.');

            return $this->redirect(route('gallery'), navigate: true);
        }
    }

    public function render()
    {
        $collections = Gallery::paginate(8);

        return view('livewire.gallery.gallery-cards', [
            'cards' => $collections,
        ]);
    }
}
