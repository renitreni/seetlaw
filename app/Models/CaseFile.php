<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseFile extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'case_id',
        'case_filename',
        'case_filepath',
        'case_fileuploader'
    ];

    public function case() : BelongsTo
    {
        return $this->belongsTo(ClientCase::class,"case_id",'id');
    }
}
