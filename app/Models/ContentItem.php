<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ContentItem extends Model {
    protected $fillable = [
        'category_id','division_id','chapter_id','formulation_id',
        'medicine_id','disease_id','proceedure_id','user_id','status'
    ];
    public function category(){ return $this->belongsTo(Category::class); }
    public function division(){ return $this->belongsTo(Division::class); }
    public function chapter(){ return $this->belongsTo(Chapter::class); }
    public function formulation(){ return $this->belongsTo(Formulation::class); }
    public function medicine(){ return $this->belongsTo(Medicine::class); }
    public function disease(){ return $this->belongsTo(Disease::class); }
    public function proceedure(){ return $this->belongsTo(Proceedure::class); }
    public function user(){ return $this->belongsTo(User::class); }
}
