<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Agent extends Model
{
    //
    use HasFactory;

    protected $table = 'agents';

    protected $fillable = [
        'nom',
        'prenoms',
        'matricule',
        'telephone',
        'type_agent',
        'delegation_regionale_id',
        'utilisateur_id',
    ];

    public function delegationRegionale()
    {
        return $this->belongsTo(DelegationRegionale::class, 'delegation_regionale_id');
    }

    public function missionSuivis()
    {
        return $this->hasMany(MissionSuivi::class, 'agent_id');
    }

    public function utilisateur()
    {
        return $this->belongsTo(User::class,'utilisateur_id');
    }
}
