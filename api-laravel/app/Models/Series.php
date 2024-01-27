<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Series extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'cover'];

    public function seasons(): HasMany
    {
        return $this->hasMany(Season::class, 'series_id');
    }

    public function episodes(): HasManyThrough
    {
        return $this->hasManyThrough(Episode::class, Season::class);
    }

    protected static function booted(): void
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('nome');
        });
    }
}
