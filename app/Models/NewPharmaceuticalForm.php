<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewPharmaceuticalForm extends Model
{
    protected $fillable = ['pharmaceutical_form_id', 'name'];

    public function pharmaceuticalForm()
    {
        return $this->belongsTo(PharmaceuticalForm::class);
    }

    public function manufacturingCompanies()
    {
        return $this->belongsToMany(ManufacturingCompany::class, 'new_pharmaceutical_form_manufacturing_company')->withTimestamps();
    }
}
