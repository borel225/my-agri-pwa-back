<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departement extends Model
{
    //
    use HasFactory;

    protected $table = 'departements';

    protected $fillable = ['nom', 'delegation_regionale_id'];

    public function delegationRegionale()
    {
        return $this->belongsTo(DelegationRegionale::class, 'delegation_regionale_id');
    }

    public function sousPrefectures()
    {
        return $this->hasMany(SousPrefecture::class, 'departement_id');
    }

    public function operateurs()
    {
        return $this->hasMany(Operateur::class, 'departement_id');
    }
}
