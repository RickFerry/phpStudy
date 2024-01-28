<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Series extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'cover'];
    protected $appends = ['links'];

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

    public function links(): Attribute
    {
        return new Attribute(
            get: fn () => [
                [
                    'rel' => 'self',
                    'href' => "/api/series/{$this->id}",
                ],
                [
                    'rel' => 'episodes',
                    'href' => "/api/series/{$this->id}/seasons",
                ],
                [
                    'rel' => 'seasons',
                    'href' => "/api/series/{$this->id}/episodes",
                ],
            ]
        );
    }
}
