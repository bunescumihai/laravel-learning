<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'address',
        'image',
    ];

    public function contacts(): HasMany{
        return $this->hasMany(ClientContact::class, 'client_id', 'id');
    }

    public function annonces(): HasMany{
        return $this->hasMany(Annonce::class, 'client_id', 'id');
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
