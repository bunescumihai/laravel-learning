<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Annonce extends Model
{
    use SoftDeletes, HasUuids;

    public $timestamps = true;

    protected $fillable = [
        'client_id',
        'title',
        'description',
        'address',
        'specifications',
        'use_client_contacts',
        'annonce_type',
    ];

}
