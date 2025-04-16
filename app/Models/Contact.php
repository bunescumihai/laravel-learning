<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contact extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'foreign_id',
        'type',
        'value',
    ];

    public function client(): HasOne{
        return $this->hasOne(Client::class, 'id', 'foreign_id');
    }
}
