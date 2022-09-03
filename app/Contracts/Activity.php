<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Collection;

interface Activity
{
    public function object(): MorphTo;

    public function causer(): MorphTo;

    public function getExtraProperty(string $propertyName): mixed;

    public function changes(): Collection;

    public function scopeInLog(Builder $query, ...$logNames): Builder;

    public function scopeCausedBy(Builder $query, Model $causer): Builder;

    public function scopeForEvent(Builder $query, string $event): Builder;

    public function scopeForObject(Builder $query, Model $object): Builder;
}