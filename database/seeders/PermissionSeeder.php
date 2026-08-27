<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [

            // Recensement
            [
                'nom' => 'Consulter le recensement',
                'code' => 'recensement.view',
                'module' => 'recensement',
                'action' => 'view',
            ],
            [
                'nom' => 'Créer un recensement',
                'code' => 'recensement.create',
                'module' => 'recensement',
                'action' => 'create',
            ],
            [
                'nom' => 'Modifier un recensement',
                'code' => 'recensement.update',
                'module' => 'recensement',
                'action' => 'update',
            ],
            [
                'nom' => 'Supprimer un recensement',
                'code' => 'recensement.delete',
                'module' => 'recensement',
                'action' => 'delete',
            ],

            // Distribution cartes
            [
                'nom' => 'Consulter la distribution des cartes',
                'code' => 'distribution_cartes.view',
                'module' => 'distribution_cartes',
                'action' => 'view',
            ],
            [
                'nom' => 'Créer une distribution de carte',
                'code' => 'distribution_cartes.create',
                'module' => 'distribution_cartes',
                'action' => 'create',
            ],
            [
                'nom' => 'Modifier une distribution de carte',
                'code' => 'distribution_cartes.update',
                'module' => 'distribution_cartes',
                'action' => 'update',
            ],
            [
                'nom' => 'Supprimer une distribution de carte',
                'code' => 'distribution_cartes.delete',
                'module' => 'distribution_cartes',
                'action' => 'delete',
            ],

            // Gestion litiges
            [
                'nom' => 'Consulter les litiges',
                'code' => 'gestion_litiges.view',
                'module' => 'gestion_litiges',
                'action' => 'view',
            ],
            [
                'nom' => 'Créer un litige',
                'code' => 'gestion_litiges.create',
                'module' => 'gestion_litiges',
                'action' => 'create',
            ],
            [
                'nom' => 'Modifier un litige',
                'code' => 'gestion_litiges.update',
                'module' => 'gestion_litiges',
                'action' => 'update',
            ],
            [
                'nom' => 'Supprimer un litige',
                'code' => 'gestion_litiges.delete',
                'module' => 'gestion_litiges',
                'action' => 'delete',
            ],

            // Commercialisation
            [
                'nom' => 'Consulter la commercialisation',
                'code' => 'commercialisation.view',
                'module' => 'commercialisation',
                'action' => 'view',
            ],
            [
                'nom' => 'Créer une commercialisation',
                'code' => 'commercialisation.create',
                'module' => 'commercialisation',
                'action' => 'create',
            ],
            [
                'nom' => 'Modifier une commercialisation',
                'code' => 'commercialisation.update',
                'module' => 'commercialisation',
                'action' => 'update',
            ],
            [
                'nom' => 'Supprimer une commercialisation',
                'code' => 'commercialisation.delete',
                'module' => 'commercialisation',
                'action' => 'delete',
            ],

            // Gestion outils
            [
                'nom' => 'Consulter la gestion des outils',
                'code' => 'gestion_outils.view',
                'module' => 'gestion_outils',
                'action' => 'view',
            ],
            [
                'nom' => 'Créer une gestion des outils',
                'code' => 'gestion_outils.create',
                'module' => 'gestion_outils',
                'action' => 'create',
            ],
            [
                'nom' => 'Modifier la gestion des outils',
                'code' => 'gestion_outils.update',
                'module' => 'gestion_outils',
                'action' => 'update',
            ],
            [
                'nom' => 'Supprimer la gestion des outils',
                'code' => 'gestion_outils.delete',
                'module' => 'gestion_outils',
                'action' => 'delete',
            ],

            // Suivi producteur
            [
                'nom' => 'Consulter le suivi producteur',
                'code' => 'suivi_producteur.view',
                'module' => 'suivi_producteur',
                'action' => 'view',
            ],
            [
                'nom' => 'Créer un suivi producteur',
                'code' => 'suivi_producteur.create',
                'module' => 'suivi_producteur',
                'action' => 'create',
            ],
            [
                'nom' => 'Modifier un suivi producteur',
                'code' => 'suivi_producteur.update',
                'module' => 'suivi_producteur',
                'action' => 'update',
            ],
            [
                'nom' => 'Supprimer un suivi producteur',
                'code' => 'suivi_producteur.delete',
                'module' => 'suivi_producteur',
                'action' => 'delete',
            ],

            // Codification
            [
                'nom' => 'Consulter la codification',
                'code' => 'codification.view',
                'module' => 'codification',
                'action' => 'view',
            ],
            [
                'nom' => 'Créer une codification',
                'code' => 'codification.create',
                'module' => 'codification',
                'action' => 'create',
            ],
            [
                'nom' => 'Modifier une codification',
                'code' => 'codification.update',
                'module' => 'codification',
                'action' => 'update',
            ],
            [
                'nom' => 'Supprimer une codification',
                'code' => 'codification.delete',
                'module' => 'codification',
                'action' => 'delete',
            ],

                        // Campagnes
            [
                'nom' => 'Consulter les campagnes',
                'code' => 'campagnes.view',
                'module' => 'campagnes',
                'action' => 'view',
            ],
            [
                'nom' => 'Créer une campagne',
                'code' => 'campagnes.create',
                'module' => 'campagnes',
                'action' => 'create',
            ],
            [
                'nom' => 'Modifier une campagne',
                'code' => 'campagnes.update',
                'module' => 'campagnes',
                'action' => 'update',
            ],
            [
                'nom' => 'Supprimer une campagne',
                'code' => 'campagnes.delete',
                'module' => 'campagnes',
                'action' => 'delete',
            ],


            // Missions
            [
                'nom' => 'Consulter les missions',
                'code' => 'missions.view',
                'module' => 'missions',
                'action' => 'view',
            ],
            [
                'nom' => 'Créer une mission',
                'code' => 'missions.create',
                'module' => 'missions',
                'action' => 'create',
            ],
            [
                'nom' => 'Modifier une mission',
                'code' => 'missions.update',
                'module' => 'missions',
                'action' => 'update',
            ],
            [
                'nom' => 'Supprimer une mission',
                'code' => 'missions.delete',
                'module' => 'missions',
                'action' => 'delete',
            ],


            // Agents
            [
                'nom' => 'Consulter les agents',
                'code' => 'agents.view',
                'module' => 'agents',
                'action' => 'view',
            ],
            [
                'nom' => 'Créer un agent',
                'code' => 'agents.create',
                'module' => 'agents',
                'action' => 'create',
            ],
            [
                'nom' => 'Modifier un agent',
                'code' => 'agents.update',
                'module' => 'agents',
                'action' => 'update',
            ],
            [
                'nom' => 'Supprimer un agent',
                'code' => 'agents.delete',
                'module' => 'agents',
                'action' => 'delete',
            ],


            // Délégations régionales
            [
                'nom' => 'Consulter les délégations régionales',
                'code' => 'delegations.view',
                'module' => 'delegations',
                'action' => 'view',
            ],
            [
                'nom' => 'Créer une délégation régionale',
                'code' => 'delegations.create',
                'module' => 'delegations',
                'action' => 'create',
            ],
            [
                'nom' => 'Modifier une délégation régionale',
                'code' => 'delegations.update',
                'module' => 'delegations',
                'action' => 'update',
            ],
            [
                'nom' => 'Supprimer une délégation régionale',
                'code' => 'delegations.delete',
                'module' => 'delegations',
                'action' => 'delete',
            ],


            // Départements
            [
                'nom' => 'Consulter les départements',
                'code' => 'departements.view',
                'module' => 'departements',
                'action' => 'view',
            ],
            [
                'nom' => 'Créer un département',
                'code' => 'departements.create',
                'module' => 'departements',
                'action' => 'create',
            ],
            [
                'nom' => 'Modifier un département',
                'code' => 'departements.update',
                'module' => 'departements',
                'action' => 'update',
            ],
            [
                'nom' => 'Supprimer un département',
                'code' => 'departements.delete',
                'module' => 'departements',
                'action' => 'delete',
            ],


            // Sous-préfectures
            [
                'nom' => 'Consulter les sous-préfectures',
                'code' => 'sous_prefectures.view',
                'module' => 'sous_prefectures',
                'action' => 'view',
            ],
            [
                'nom' => 'Créer une sous-préfecture',
                'code' => 'sous_prefectures.create',
                'module' => 'sous_prefectures',
                'action' => 'create',
            ],
            [
                'nom' => 'Modifier une sous-préfecture',
                'code' => 'sous_prefectures.update',
                'module' => 'sous_prefectures',
                'action' => 'update',
            ],
            [
                'nom' => 'Supprimer une sous-préfecture',
                'code' => 'sous_prefectures.delete',
                'module' => 'sous_prefectures',
                'action' => 'delete',
            ],


            // Localités
            [
                'nom' => 'Consulter les localités',
                'code' => 'localites.view',
                'module' => 'localites',
                'action' => 'view',
            ],
            [
                'nom' => 'Créer une localité',
                'code' => 'localites.create',
                'module' => 'localites',
                'action' => 'create',
            ],
            [
                'nom' => 'Modifier une localité',
                'code' => 'localites.update',
                'module' => 'localites',
                'action' => 'update',
            ],
            [
                'nom' => 'Supprimer une localité',
                'code' => 'localites.delete',
                'module' => 'localites',
                'action' => 'delete',
            ],

            // Administration
            [
                'nom' => 'Gérer les utilisateurs',
                'code' => 'users.manage',
                'module' => 'administration',
                'action' => 'users.manage',
            ],
            [
                'nom' => 'Gérer les rôles',
                'code' => 'roles.manage',
                'module' => 'administration',
                'action' => 'roles.manage',
            ],
            [
                'nom' => 'Gérer les permissions',
                'code' => 'permissions.manage',
                'module' => 'administration',
                'action' => 'permissions.manage',
            ],
        ];

        foreach ($permissions as $permission) {

            Permission::updateOrCreate(
                [
                    'code' => $permission['code']
                ],
                $permission
            );

        }
    }
    
}
