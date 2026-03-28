<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommercialOushadhaKalpana extends Model
{
    protected $fillable = ['formulation_id', 'name', 'description'];

    public function formulation()
    {
        return $this->belongsTo(Formulation::class);
    }
}
