<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Parcelle extends Model
{
    //
    use HasFactory;

    protected $table = 'parcelles';

    protected $fillable = [
        'producteur_id',
        'code_parcelle',
        'type_parcelle',
        'superficie_ha',
        'localite_id',
        'latitude',
        'longitude',
    ];

    public function producteur()
    {
        return $this->belongsTo(Producteur::class, 'producteur_id');
    }

    public function localite()
    {
        return $this->belongsTo(Localite::class, 'localite_id');
    }

    public function recensements()
    {
        return $this->belongsToMany(Recensement::class,'recensement_parcelle')
        ->withPivot([
            'superficie_levee',
            'geolocalisee'
        ]);
    }

    public function ayantsDroit()
    {
        return $this->belongsToMany(AyantDroit::class,'ayant_droit_parcelles')
        ->withPivot('superficie_attribuee_ha')
        ->withTimestamps();
    }
        public function gestionLitiges()
    {
        return $this->hasMany(GestionLitige::class, 'parcelle_id');
    }
}
