<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Chapter extends Model {
    protected $fillable = ['name','slug','description','user_id','status'];
    public function divisions(){ return $this->belongsToMany(Division::class,'division_chapter')->withTimestamps(); }
    public function formulations(){ return $this->belongsToMany(Formulation::class,'chapter_formulation')->withTimestamps(); }
    public function contentItems(){ return $this->hasMany(ContentItem::class); }
}
