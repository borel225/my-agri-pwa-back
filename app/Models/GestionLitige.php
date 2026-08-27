<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GestionLitige extends Model
{
    //
    use HasFactory;

    protected $table = 'gestion_litiges';

    protected $fillable = [
        'mission_suivi_id',
        'parcelle_id',
        'motif_changement_propriete',
        'qualite_autorite_villageoise',
        'nom_autorite_villageoise',
        'visa_autorite_villageoise',
        'date_collecte',
        'statut_litige',
    ];

    public function missionSuivi()
    {
        return $this->belongsTo(MissionSuivi::class, 'mission_suivi_id');
    }

    public function parcelle()
    {
        return $this->belongsTo(Parcelle::class, 'parcelle_id');
    }

    public function ayantDroits()
    {
        return $this->hasMany(AyantDroit::class, 'gestion_litige_id');
    }
        
    
}
