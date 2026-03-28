<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmaceuticalForm extends Model
{
    protected $fillable = ['name'];

    public function newPharmaceuticalForms()
    {
        return $this->hasMany(NewPharmaceuticalForm::class);
    }
}
