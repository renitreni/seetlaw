<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientCase extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'case_number',
        "case_plaintiff",
        "case_defendant",
        'case_relation',
        "case_type",
        "case_status",
        "case_description",
        "case_docsready",
        'case_files',
        "case_date"
    ];

    protected static function boot() : void
    {
        parent::boot();

        static::creating(function($case){
            $case->case_number = static::generateCaseNumber();
        });
    }

    protected static function generateCaseNumber() : string
    {
        return 'CASE-' . str_pad(ClientCase::count() + 1,5,'0',STR_PAD_LEFT);
    }

    public function court() : HasMany
    {
        return $this->hasMany(ClientCourt::class,'case_id','id');
    }

    public function files() : HasMany
    {
        return $this->hasMany(CaseFile::class,"case_id",'id');
    }

    public function client() : HasOne
    {
        return $this->hasOne(ClientInfo::class,"case_id","id");
    }
}
