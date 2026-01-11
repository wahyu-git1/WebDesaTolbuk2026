<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $guarded = ['id'];

    // protected $fillable = [
    //     'category_id',
    //     'title',
    //     'slug',
    //     'excerpt',
    //     'body',
    //     'image',
    //     'published_at',

    // ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
