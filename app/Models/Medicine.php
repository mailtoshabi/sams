<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Medicine extends Model {
    protected $fillable = ['name','slug','heading','description','image_path','user_id','status'];
    public function titles(){ return $this->belongsToMany(Title::class,'medicine_title')->withPivot(['heading','description','image_path'])->withTimestamps(); }
    public function formulation(){ return $this->belongsTo(Formulation::class); }
    public function contentItems(){ return $this->hasMany(ContentItem::class); }
    public function user(){ return $this->belongsTo(User::class); }
}
