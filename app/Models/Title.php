<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Title extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'status', 'user_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($title) {
            $title->slug = Str::slug($title->name);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medicines(){ return $this->belongsToMany(Medicine::class,'medicine_title')->withPivot(['heading','description','image_path'])->withTimestamps(); }
    public function diseases(){ return $this->belongsToMany(Disease::class,'disease_title')->withPivot(['heading','description','image_path'])->withTimestamps(); }
    public function proceedures(){ return $this->belongsToMany(Proceedure::class,'proceedure_title')->withPivot(['heading','description','image_path'])->withTimestamps(); }
}

