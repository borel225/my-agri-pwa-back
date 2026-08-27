<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DelegationRegionale;
use App\Models\Departement;
use App\Models\SousPrefecture;
use App\Models\Localite;
use App\Models\Campagne;
use App\Models\Agent;
use App\Models\MissionSuivi;
use App\Models\Producteur;
use App\Models\Parcelle;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Délégation

        $dr = DelegationRegionale::create([
            'code_dr'=>'DR001',
            'nom'=>'Abidjan Sud'
        ]);



        // Département

        $dep = Departement::create([
            'nom'=>'Abidjan',
            'delegation_regionale_id'=>$dr->id
        ]);



        // Sous préfecture

        $sp = SousPrefecture::create([
            'nom'=>'Yopougon',
            'departement_id'=>$dep->id
        ]);



        // Localité

        $localite = Localite::create([
            'nom'=>'Terminus 27',
            'sous_prefecture_id'=>$sp->id
        ]);



        // Campagne

        $campagne = Campagne::create([
            'code_semaine'=>'S01-2026',
            'date_debut'=>'2026-07-01',
            'date_fin'=>'2026-07-07'
        ]);



        // Agent

        $agent = Agent::create([
            'nom'=>'Kouadio Jean',
            'matricule'=>'AG001',
            'telephone'=>'0700000000',
            'type_agent'=>'Agent recenseur',
            'delegation_regionale_id'=>$dr->id
        ]);



        // Mission

        $mission = MissionSuivi::create([
            'campagne_id'=>$campagne->id,
            'agent_id'=>$agent->id,
            'localite_id'=>$localite->id,
            'observation'=>'Mission test'
        ]);



        // Producteur

        $producteur = Producteur::create([
            'code_producteur'=>'PRD001',
            'nom'=>'Kouassi',
            'prenoms'=>'André',
            'contact'=>'0500000000',
            'date_recensement'=>'2026-07-28'
        ]);



        // Parcelle

        Parcelle::create([
            'producteur_id'=>$producteur->id,
            'code_parcelle'=>'PAR001',
            'type_parcelle'=>'CACAO',
            'superficie_ha'=>5,
            'localite_id'=>$localite->id
        ]);

    }
}
