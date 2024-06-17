<?php

namespace App\Livewire\Invoice;

use Exception;
use App\Models\Invoice;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InvoiceTable extends Component
{
    public string $search = "";
    public $data;

    public function populateModal(int $id)
    {
        return $this->data = Invoice::where('id',$id)->with("services")->first();
    }

    public function download(int $id)
    {
       return redirect()->route('download_invoice',['id'=>$id]);
    }

    public function deleteConfirm(Invoice $invoice)
    {
        $this->data = $invoice;
    }

    public function delete(Invoice $invoice)
    {
        try{
            $in_number = $invoice->invoice_number;
            $invoice->delete();
            session()->flash('success',"{$in_number} successfully deleted.");
            return $this->redirect(route('invoice'),navigate:true);
        }catch(Exception $exception){
            Log::error('@delete_invoice',[
                'msg'=>$exception->getMessage()
            ]);
            session()->flash('failed',"Failed to delete invoice {$in_number}");
            return $this->redirect(route('invoice'),navigate:true);
        }
    }

    #[On('invoice_created')]
    public function render() : View
    {
        $result = $this->search != "" ? $this->getSearchInvoice() : $this->getAllInvoice();
        return view('livewire.invoice.invoice-table')->with('collection',$result);
    }

    private function getAllInvoice() : LengthAwarePaginator
    {
        return Invoice::paginate(5);
    }

    private function getSearchInvoice() : Collection
    {
        return Invoice::where("invoice_number","%{$this->search}%")->first();
    }


}
