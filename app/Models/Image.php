<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'image',
    ];

    public function annonce(): BelongsTo{
        return $this->belongsTo(Annonce::class, 'annonce_id', 'id');
    }
}
