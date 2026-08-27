<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recensement extends Model
{
    //
    use HasFactory;

    protected $table = 'recensements';

    protected $fillable = [
        'producteur_id',
        'mission_suivi_id',
        'date_recensement',
        'observation_recensement',
        'parcelle_declaree',
        'nb_parcelle_levee',
        'parcelles_restant_levee',
    ];

    public function producteur()
    {
        return $this->belongsTo(Producteur::class, 'producteur_id');
    }

    public function missionSuivi()
    {
        return $this->belongsTo(MissionSuivi::class, 'mission_suivi_id');
    }

    public function parcelles()
    {
        return $this->belongsToMany(Parcelle::class,'recensement_parcelle')
        ->withPivot([
            'superficie_levee',
            'geolocalisee'
        ]);
    }
}
