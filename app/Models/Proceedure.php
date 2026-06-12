<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Proceedure extends Model {
    protected $fillable = ['name', 'ayurveda_name','slug','heading','description','image_path','user_id','status', 'division_id'];
    public function titles(){ return $this->belongsToMany(Title::class,'proceedure_title')->withPivot(['heading','description','image_path'])->withTimestamps(); }
    public function division(){ return $this->belongsTo(Division::class); }
    public function contentItems(){ return $this->hasMany(ContentItem::class); }
    public function user(){ return $this->belongsTo(User::class); }
    public function modernDiseases(){ return $this->belongsToMany(ModernDisease::class, 'modern_disease_proceedure')->withPivot('description')->withTimestamps(); }
}
