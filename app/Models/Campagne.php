<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campagne extends Model
{
    //
    use HasFactory;

    protected $table = 'campagnes';

    protected $fillable = [

    'code_semaine',

    'libelle',

    'date_debut',

    'date_fin',

    'statut',

    'observation'

    ];

    public function missionSuivis()
    {
        return $this->hasMany(MissionSuivi::class, 'campagne_id');
    }
}
