<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientCourt extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "case_id",
        "court_name",
        "court_address",
        "court_date",
    ];
    public function case() : BelongsTo
    {
        return $this->belongsTo(ClientCase::class,"case_id","id");
    }
}
