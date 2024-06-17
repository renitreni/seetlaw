<?php

namespace App\Livewire\Invoice;

use App\Models\Invoice;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

class Modal extends Component
{

    #[Validate]
    public $services = [];
    #[Validate]
    public string $customer_name = "";
    #[Validate]
    public string $customer_address = "";
    #[Validate]
    public string $customer_phone = "";
    public float $sub_total = 0;
    public float $vat = 0.15;
    public float $total_amount = 0;

    public function rules(): array
    {
        return [
            'customer_name' => 'required|min:3',
            'customer_address' => 'required|min:3',
            'customer_phone' => 'required',
            'services.*' => 'required'
        ];
    }

    public function mount()
    {
        $this->addService();
    }

    public function updatedServices(): void
    {
        $this->sub_total = 0;
        foreach ($this->services as $service) {
            if (empty($service['service_amount'])) {
                $service['service_amount'] = 0;
            }
            $this->sub_total += $service['service_amount'];
        }
        $vat_amount = $this->sub_total * $this->vat;
        $this->total_amount = $this->sub_total + $vat_amount;
    }


    #[On('addService')]
    public function addService(): array
    {
        return $this->services[] = [
            'service_name' => "",
            'service_amount' => ""
        ];
    }
    public function removeService(int $index): array
    {

        if (isset($this->services[$index])) {
            unset($this->services[$index]);
        }
        $this->updatedServices();
        return $this->services;
    }

    public function create()
    {
        try {
            $invoice = Invoice::create($this->all());
            foreach ($this->services as $service) {
                $invoice->services()->create($service);
            }
            $this->reset();
            $this->dispatch('invoice_created');
            return session()->flash('success','Invoice created.');
        } catch (Exception $exception) {
            Log::error("@create_invoice",['msg'=>$exception->getMessage()]);
            return session()->flash('failed','Failed to create invoice.');
        }
    }

    public function render()
    {
        return view('livewire.invoice.modal');
    }
}
