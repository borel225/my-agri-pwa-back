<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Localite extends Model
{
    //
    use HasFactory;

    protected $table = 'localites';

    protected $fillable = ['nom', 'sous_prefecture_id'];

    public function sousPrefecture()
    {
        return $this->belongsTo(SousPrefecture::class, 'sous_prefecture_id');
    }

    public function parcelles()
    {
        return $this->hasMany(Parcelle::class, 'localite_id');
    }

    public function missionSuivis()
    {
        return $this->hasMany(MissionSuivi::class, 'localite_id');
    }

}
