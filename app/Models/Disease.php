<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Disease extends Model {
    protected $fillable = ['name', 'ayurveda_name','slug','heading','description','image_path','user_id','status'];
    public function titles(){ return $this->belongsToMany(Title::class,'disease_title')->withPivot(['heading','description','image_path'])->withTimestamps(); }
    public function contentItems(){ return $this->hasMany(ContentItem::class); }
    public function user(){ return $this->belongsTo(User::class); }
}
