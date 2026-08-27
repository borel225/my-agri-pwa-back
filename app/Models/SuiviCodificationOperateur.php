<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuiviCodificationOperateur extends Model

{
    //
    use HasFactory;

    protected $table = 'suivi_codification_operateurs';

    protected $fillable = [
        'operateur_id',
        'mission_suivi_id',
        'demande_soumise',
        'demande_traitee_dr',
        'demande_validee_stpt',
        'observation_codification',
        'nbre_delegues_sydore',
        'nbre_delegues_setbc',
        'nbre_cartes_editees',
        'nbre_magasin_geolocalise',
        'observation_personnel',
        'kyc_soumis',
        'kyc_valide',
        'motif_non_conformite',
        'operateur_forme_deploye',
        'observation_enrolement',
    ];

    public function operateur()
    {
        return $this->belongsTo(Operateur::class, 'operateur_id');
    }

    public function missionSuivi()
    {
        return $this->belongsTo(MissionSuivi::class, 'mission_suivi_id');
    }
}
