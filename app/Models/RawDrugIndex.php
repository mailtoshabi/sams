<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RawDrugIndex extends Model
{
    protected $fillable = ['name', 'local_name', 'sanskrit_name', 'botanical_name', 'part_used'];

    protected $table = 'raw_drug_indices';
}
