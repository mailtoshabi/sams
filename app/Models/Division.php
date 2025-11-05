<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = ['name', 'slug', 'description','user_id','status'];

    public function categories(){ return $this->belongsToMany(Category::class,'category_division')->withTimestamps(); }
    public function chapters(){ return $this->belongsToMany(Chapter::class,'division_chapter')->withTimestamps(); }
    public function proceedures(){ return $this->belongsToMany(Proceedure::class,'division_proceedure')->withTimestamps(); }
    public function contentItems(){ return $this->hasMany(ContentItem::class); }
}
