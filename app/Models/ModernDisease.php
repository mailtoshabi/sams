<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModernDisease extends Model
{
    protected $fillable = ['division_id', 'disease_id'];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'medicine_modern_disease')->withTimestamps();
    }

    public function proceedures()
    {
        return $this->belongsToMany(Proceedure::class, 'modern_disease_proceedure')->withPivot('description')->withTimestamps();
    }
}
