<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Formulation extends Model {
    protected $fillable = ['name', 'ayurveda_name','slug','description','user_id','status'];
    public function categories(){ return $this->belongsToMany(Category::class,'category_formulation')->withTimestamps(); }
    public function chapters(){ return $this->belongsToMany(Chapter::class,'chapter_formulation')->withTimestamps(); }
    public function contentItems(){ return $this->hasMany(ContentItem::class); }
    public function medicines(){ return $this->hasMany(Medicine::class); }
}
