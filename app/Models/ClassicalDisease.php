<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassicalDisease extends Model
{
    protected $fillable = ['division_id', 'chapter_id', 'medicine_type_id', 'formulation_id', 'medicine_id'];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function medicineType()
    {
        return $this->belongsTo(MedicineType::class);
    }

    public function formulation()
    {
        return $this->belongsTo(Formulation::class);
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
