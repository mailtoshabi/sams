<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = ['name', 'ayurveda_name', 'slug', 'description','user_id','status'];

    public function categories(){ return $this->belongsToMany(Category::class,'category_division')->withTimestamps(); }
    public function chapters(){ return $this->belongsToMany(Chapter::class,'division_chapter')->withTimestamps(); }
    public function proceedures(){ return $this->hasMany(Proceedure::class); }
    public function contentItems(){ return $this->hasMany(ContentItem::class); }
    public function modernDiseases(){ return $this->hasMany(ModernDisease::class); }
    public function diseases(){ return $this->belongsToMany(Disease::class, 'modern_diseases')->withTimestamps(); }
    public function classicalDiseases(){ return $this->hasMany(ClassicalDisease::class); }
}
