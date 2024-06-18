<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientInfo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'case_id',
        'client_company',
        'client_representative',
        'client_email',
        'client_mobile',
    ];

    public function case(): BelongsTo
    {
        return $this->belongsTo(ClientCase::class, 'case_id', 'id');
    }
}
