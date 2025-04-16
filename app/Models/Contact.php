<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contact extends Model
{
    protected $fillable = [
        'foreign_id',
        'type',
        'value',
    ];

    public $timestamps = false;

    public function client(): HasOne{
        return $this->hasOne(Client::class, 'id', 'foreign_id');
    }

}
