<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DelegationRegionale extends Model
{
    //
    use HasFactory;

    protected $table = 'delegation_regionales';

    protected $fillable = ['code_dr', 'nom'];

    public function departements()
    {
        return $this->hasMany(Departement::class, 'delegation_regionale_id');
    }

    public function agents()
    {
        return $this->hasMany(Agent::class, 'delegation_regionale_id');
    }
}
