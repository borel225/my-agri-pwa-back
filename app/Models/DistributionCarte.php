<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DistributionCarte extends Model
{
    //
    use HasFactory;

    protected $table = 'distribution_cartes';

    protected  $fillable = [
        'producteur_id',
        'mission_suivi_id',
        'date_distribution',
        'lieu_distribution',
        'telephone_kyc',
        'kyc_synchronise',
        'carte_activee',
        'motif_non_activation',
    ];

    public function producteur()
    {
        return $this->belongsTo(Producteur::class, 'producteur_id');
    }

    public function missionSuivi()
    {
        return $this->belongsTo(MissionSuivi::class, 'mission_suivi_id');
    }
}
