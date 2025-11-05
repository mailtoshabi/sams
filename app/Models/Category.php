<?php

namespace App\Models;

use App\Http\Utilities\Utility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    const DIR_STORAGE = 'storage/categories/';
    const DIR_PUBLIC = 'categories/';

    protected $hidden = ['id'];

    protected $fillable = ['name', 'slug', 'fa_icon', 'description'];

    protected $casts = ['status'=>'boolean'];

    public function scopeActive($query) {
        return $query->where('status',Utility::ITEM_ACTIVE);
    }

    public function scopeOldestById($query) {
        return $query->orderBy('id', 'asc');
    }

    public function divisions(){ return $this->belongsToMany(Division::class,'category_division')->withTimestamps(); }
    public function formulations(){ return $this->belongsToMany(Formulation::class,'category_formulation')->withTimestamps(); }
    public function contentItems(){ return $this->hasMany(ContentItem::class); }
}
