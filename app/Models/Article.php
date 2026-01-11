<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $guarded = ['id'];

    // protected $fillable = [
    //     'name',
    //     'slug',
    // ];

    // Eager load category biar query ringan
    protected $with = ['category'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Helper untuk cari route key pakai slug, bukan ID
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
