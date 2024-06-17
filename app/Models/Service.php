<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_id',
        'service_name',
        'service_amount'
    ];

    public function invoice() : BelongsTo
    {
        return $this->belongsTo(Invoice::class,'invoice_id','id');
    }
}
