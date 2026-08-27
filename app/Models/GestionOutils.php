<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GestionOutils extends Model
{
    //
    use HasFactory;

    protected $table = 'gestion_outils';

    protected $fillable = [
        'operateur_id',
        'mission_suivi_id',
        'nombre_delegues_magasiniers_codifies',
        'tpe_demande',
        'tpe_recu',
        'tpe_fonctionnel',
        'tpe_non_fonctionnel',
        'tpe_egare',
        'scelles_demande',
        'scelles_recu',
        'scelles_projection',
        'sacherie_demande',
        'sacherie_recu',
        'sacherie_projection',
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
