<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AnnonceContact extends Model
{
    public $timestamps = false;

    const TYPE_PHONE = 1;

    const TYPE_MAP = [
        self::TYPE_PHONE => 'phone',
        2 => 'email',
    ];

    protected $fillable = [
        'contact_type_id',
        'value',
    ];

    public function annonce(): BelongsTo{
        return $this->belongsTo(Annonce::class, 'annonce_id', 'id');
    }

    public function contactType(): HasOne{
        return $this->HasOne(ContactType::class, 'id', 'contact_type_id');
    }
}
