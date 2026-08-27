<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuiviUtilisationProducteur extends Model
{
    //
    use HasFactory;

    protected $table = 'suivi_utilisation_producteurs';

    protected $fillable = [
        'producteur_id',
        'operateur_id',
        'mission_suivi_id',
        'date_passage',
        'statut_recense',
        'etat_carte',
        'type_incident',
    ];

    public function producteur()
    {
        return $this->belongsTo(Producteur::class, 'producteur_id');
    }

    public function operateur()
    {
        return $this->belongsTo(Operateur::class, 'operateur_id');
    }

    public function missionSuivi()
    {
        return $this->belongsTo(MissionSuivi::class, 'mission_suivi_id');
    }
}
