<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Client extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';

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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function email(){
        return $this->contacts()->where('type', \App\Enums\ContactTypeEnum::EMAIL->value)->value('value');
    }

    public function phone(){
        return $this->contacts()->where('type', \App\Enums\ContactTypeEnum::PHONE->value)->value('value');
    }
}
