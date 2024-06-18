<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'invoice_number',
        'customer_name',
        'customer_phone',
        'customer_address',
        'sub_total',
        'vat',
        'total_amount',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($nvoice) {
            $nvoice->invoice_number = static::generateInvoiceNumber();
        });
    }

    protected static function generateInvoiceNumber(): string
    {
        return 'INV-'.str_pad(Invoice::count() + 1, 5, '0', STR_PAD_LEFT);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'invoice_id', 'id');
    }
}
