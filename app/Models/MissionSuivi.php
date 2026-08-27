<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MissionSuivi extends Model
{
    //
    use HasFactory;

    protected $table = 'mission_suivis';

        protected $fillable = [

        'code_mission',

        'campagne_id',

        'agent_id',

        'localite_id',

        'date_mission',

        'observation',

        'statut'

    ];

    public function campagne()
    {
        return $this->belongsTo(Campagne::class, 'campagne_id');
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    public function localite()
    {
        return $this->belongsTo(Localite::class, 'localite_id');
    }

    public function sousPrefecture()
    {
        return $this->hasOneThrough(SousPrefecture::class, Localite::class,
            'id',
            'id',
            'localite_id',
            'sous_prefecture_id'
        );
    }

        public function recensements()
    {
        return $this->hasMany(Recensement::class,'mission_suivi_id');
    }

    public function distributionCartes()
    {
        return $this->hasMany(DistributionCarte::class,'mission_suivi_id');
    }

    public function suiviCommercialisations()
    {
        return $this->hasMany(SuiviCommercialisation::class,'mission_suivi_id');
    }

    public function suiviUtilisationProducteurs()
    {
        return $this->hasMany(SuiviUtilisationProducteur::class,'mission_suivi_id');
    }

    public function gestionLitiges()
    {
        return $this->hasMany(GestionLitige::class,'mission_suivi_id');
    }

    public function gestionOutils()
    {
        return $this->hasMany(GestionOutils::class,'mission_suivi_id');
    }

    public function suiviCodificationOperateurs()
    {
        return $this->hasMany(SuiviCodificationOperateur::class,'mission_suivi_id');
    }
}
