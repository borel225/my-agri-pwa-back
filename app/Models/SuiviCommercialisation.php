<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuiviCommercialisation extends Model
{
    //
    use HasFactory;

    protected $table = 'suivi_commercialisations';

    protected $fillable = [
        'operateur_id',
        'magasin_id',
        'mission_suivi_id',
        'date_passage',
        'volumes_physiques',
        'volumes_setbc',
        'connaissement_emis',
        'connaissement_receptionne',
        'connaissement_refoule',
        'nb_sacs_sans_scelles',
        'motif_sacs_sans_scelles',
        'nbre_produ_preenregistres',
        'motif_enquete',
        'observation_enquete',
    ];

    public function operateur()
    {
        return $this->belongsTo(Operateur::class, 'operateur_id');
    }

    public function missionSuivi()
    {
        return $this->belongsTo(MissionSuivi::class, 'mission_suivi_id');
    }

    public function magasin()
    {
        return $this->belongsTo(Magasin::class, 'magasin_id');
    }
}
