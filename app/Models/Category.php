<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['title', 'slug'];

        public function getRouteKeyName()
    {
        return 'slug';
    }

    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    public function approvedLinks(): HasMany
    {
        return $this->hasMany(Link::class)->where('status', 'approved');
    }
}
