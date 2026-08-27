<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AyantDroit extends Model
{
    //
    use HasFactory;

    protected $table = 'ayant_droits';

    protected $fillable = [
        'nom',
        'prenoms',
        'contact',
        'date_naissance',
        'type_piece_identite',
        'numero_piece',
        'producteur_id',
        'gestion_litige_id',
    ];


    public function producteur()
    {
        return $this->belongsTo(Producteur::class, 'producteur_id');
    }

    public function parcelles()
    {
        return $this->belongsToMany(Parcelle::class,
            'ayant_droit_parcelles',
            'ayant_droit_id',
            'parcelle_id'
        )
        ->withPivot('superficie_attribuee_ha')
        ->withTimestamps();
    }

    public function gestionLitige()
    {
        return $this->belongsTo(GestionLitige::class, 'gestion_litige_id');
    }

}
