<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManufacturingCompany extends Model
{
    protected $fillable = ['name'];

    public function newPharmaceuticalForms()
    {
        return $this->belongsToMany(NewPharmaceuticalForm::class, 'new_pharmaceutical_form_manufacturing_company')->withTimestamps();
    }
}
