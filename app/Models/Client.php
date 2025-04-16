<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasUuids;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'address',
        'image',
    ];

    public function contacts(): HasMany{
        return $this->hasMany(Contact::class, 'foreign_id', 'id');
    }

    public function annonces(): HasMany{
        return $this->hasMany(Annonce::class, 'client_id', 'id');
    }

    public function email(){
        return $this->contacts()->where('type', \App\Enums\ContactTypeEnum::EMAIL->value)->value('value');
    }

    public function phone(){
        return $this->contacts()->where('type', \App\Enums\ContactTypeEnum::PHONE->value)->value('value');
    }
}
