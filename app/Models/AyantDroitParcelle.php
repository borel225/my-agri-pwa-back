<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AyantDroitParcelle extends Model
{
    //
     use HasFactory;

    protected $table = 'ayant_droit_parcelles';

    protected $fillable = [
        'ayant_droit_id',
        'parcelle_id',
        'superficie_attribuee_ha',
    ];


    public function ayantDroit()
    {
        return $this->belongsTo(
            AyantDroit::class,
            'ayant_droit_id'
        );
    }


    public function parcelle()
    {
        return $this->belongsTo(
            Parcelle::class,
            'parcelle_id'
        );
    }
}
