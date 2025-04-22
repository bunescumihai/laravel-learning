<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\ContactTypeEnum;

class Annonce extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'client_id',
        'title',
        'description',
        'address',
        'specifications',
        'use_client_contacts',
        'annonce_type',
        'start_publication_date',
        'end_publication_date',
    ];

    protected $casts = [
        'specifications' => 'array'
    ];

    public function images(): HasMany{
        return $this->hasMany(Image::class, 'annonce_id', 'id');
    }

    public function firstImage(){
        return $this->images()->first()['image'];
    }

    public function client(): belongsTo{
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function contacts(): HasMany{
        return $this->hasMany(AnnonceContact::class, 'annonce_id', 'id');
    }
}
