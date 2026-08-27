<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producteur extends Model
{
    //
    use HasFactory;

    protected $table = 'producteurs';

    protected $fillable = [
        'code_producteur',
        'nom',
        'prenoms',
        'contact',
        'date_naissance',
        'type_piece_identite',
        'numero_piece',
        'statut_donnees',
        'date_recensement',
    ];

    public function parcelles()
    {
        return $this->hasMany(Parcelle::class, 'producteur_id');
    }
        public function ayantsDroits()
    {
        return $this->hasMany(AyantDroit::class, 'producteur_id');
    }
}
