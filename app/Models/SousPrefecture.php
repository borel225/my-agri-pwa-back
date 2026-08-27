<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SousPrefecture extends Model
{
    //
    use HasFactory;

    protected $table = 'sous_prefectures';

    protected $fillable = ['nom', 'departement_id'];

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    public function localites()
    {
        return $this->hasMany(Localite::class, 'sous_prefecture_id');
    }
}
