<?php

namespace App\Http\Controllers;

use App\Models\Invoice as ModelInvoice;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Invoice;

class InvoiceController extends Controller
{
    public function __invoke(int $id)
    {
        $data = ModelInvoice::with('services')->findOrFail($id);
        $item = [];

        $client = new Party([
            'name' => 'Seet Law',
            'address' => 'Kingdom of Saudi Arabia',
            'phone' => '50124331',
            'custom_fields' => [
                'email' => 'info@seetlaw.sa',
            ],
        ]);

        $customer = new Party([
            'name' => $data->customer_name,
            'address' => $data->customer_address,
            'phone' => $data->customer_phone,
        ]);

        foreach ($data->services as $service) {
            $item[] = InvoiceItem::make($service->service_name)->pricePerUnit($service->service_amount);
        }

        $notes = [
            'Hello there.',
            'Thank you for trusting us.',
        ];
        $notes = implode('<br>', $notes);

        $invoice = Invoice::make()
            ->seller($client)
            ->series($data->invoice_number)
            ->serialNumberFormat('{SERIES}')
            ->buyer($customer)
            ->date($data->created_at)
            ->dateFormat('F d, Y')
            ->currencyCode('SAR')
            ->currencySymbol('SAR')
            ->currencyFormat('{SYMBOL} {VALUE}')
            ->currencyDecimalPoint('.')
            ->currencyThousandsSeparator(',')
            ->taxRate(15)
            ->addItems($item)
            ->notes($notes)
            ->filename("{$data->customer_name}-{$data->invoice_number}");

        return $invoice->stream();
    }
}
