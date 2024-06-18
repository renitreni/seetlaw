<?php

namespace App\Livewire\Cases;

use App\Models\ClientCase;
use Livewire\Component;

class CaseTable extends Component
{
    public $data = null;

    public function view(int $id)
    {
        return $this->redirect(route('view_case', ['id' => $id]), navigate: true);
    }

    public function summary(int $id)
    {
        $this->data = ClientCase::with(['client', 'court'])->where('id', $id)->first();
        $this->dispatch('open-modal', 'view_details');
    }

    public function render()
    {
        $collection = ClientCase::with(['client', 'court'])->paginate(5);

        return view('livewire.cases.case-table', [
            'collections' => $collection,
        ]);
    }
}
