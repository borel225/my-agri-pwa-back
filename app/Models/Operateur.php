<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Operateur extends Model
{
    //
    use HasFactory;

    protected $table = 'operateurs';

    protected $fillable = ['code_operateur', 'sigle_operateur', 'departement_id'];

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    public function magasins()
    {
        return $this->hasMany(Magasin::class, 'operateur_id');
    }

    public function suiviCommercialisations()
    {
        return $this->hasMany(
            SuiviCommercialisation::class
        );
    }
}
