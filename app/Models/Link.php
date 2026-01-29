<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'url',
        'title',
        'description',
        'status',
        'pricing_type',
        'slug',
        'hits',
        'sort_order'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($link) {
            if (!$link->slug) {
                $link->slug = \Illuminate\Support\Str::slug($link->title) . '-' . \Illuminate\Support\Str::random(6);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
