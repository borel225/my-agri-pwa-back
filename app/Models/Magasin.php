<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Magasin extends Model
{
    //
    use HasFactory;

    protected $table = 'magasins';

    protected $fillable = ['code_magasin', 'operateur_id', 'latitude', 'longitude'];

    public function operateur()
    {
        return $this->belongsTo(Operateur::class, 'operateur_id');
    }

    public function suiviCommercialisations()
    {
        return $this->hasMany(
            SuiviCommercialisation::class);
    }
}
