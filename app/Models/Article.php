<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['heading', 'author_id', 'article'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
