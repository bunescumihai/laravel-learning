<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ClientContact extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'contact_type_id',
        'value',
    ];

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function contactType(): HasOne
    {
        return $this->hasOne(ContactType::class, 'id', 'contact_type_id');
    }
}
