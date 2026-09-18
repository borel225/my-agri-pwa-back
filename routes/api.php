<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DelegationRegionaleController;
use App\Http\Controllers\Api\DepartementController;
use App\Http\Controllers\Api\SousPrefectureController;
use App\Http\Controllers\Api\LocaliteController;
use App\Http\Controllers\Api\CampagneController;
use App\Http\Controllers\Api\MissionSuiviController;
use App\Http\Controllers\Api\AgentController;
use App\Http\Controllers\Api\ProducteurController;
use App\Http\Controllers\Api\ParcelleController;
use App\Http\Controllers\Api\RecensementController;
use App\Http\Controllers\Api\DistributionCarteController;
use App\Http\Controllers\Api\SuiviCodificationOperateurController;
use App\Http\Controllers\Api\OperateurController;
use App\Http\Controllers\Api\MagasinController;
use App\Http\Controllers\Api\SuiviCommercialisationController;
use App\Http\Controllers\Api\SuiviUtilisationProducteurController;
use App\Http\Controllers\Api\GestionOutilsController;
use App\Http\Controllers\Api\AyantDroitController;
use App\Http\Controllers\Api\AyantDroitParcelleController;
use App\Http\Controllers\Api\GestionLitigeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PermissionController;



/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION
|--------------------------------------------------------------------------
*/
Route::post(
    '/login',
    [AuthController::class, 'login']
)->middleware('throttle:5,1');


/*
|--------------------------------------------------------------------------
| ROUTES PROTÉGÉES
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {


    
    //PROFIL -------------------------------

    Route::get('/me',[AuthController::class, 'me']);
    Route::put('/me', [AuthController::class, 'updateProfile']);
    Route::put('/me/password',[AuthController::class, 'changePassword']);
    Route::post('/logout',[AuthController::class, 'logout']);

    //DONNÉES DE RÉFÉRENCE -------------------------------------------------

        // Campagnes
        Route::get('/campagnes',[CampagneController::class, 'index'])->middleware('permission:campagnes.view');
        Route::post('/campagnes',[CampagneController::class, 'store'])->middleware('permission:campagnes.create');
        Route::get('/campagnes/{campagne}',[CampagneController::class, 'show'])->middleware('permission:campagnes.view');
        Route::put('/campagnes/{campagne}',[CampagneController::class, 'update'])->middleware('permission:campagnes.update');
        Route::patch('/campagnes/{campagne}',[CampagneController::class, 'update'])->middleware('permission:campagnes.update');
        Route::delete('/campagnes/{campagne}',[CampagneController::class, 'destroy'])->middleware('permission:campagnes.delete');
    
        // Missions
        Route::get('/mission-suivis',[MissionSuiviController::class, 'index'])->middleware('permission:missions.view');
        Route::post('/mission-suivis',[MissionSuiviController::class, 'store'])->middleware('permission:missions.create');
        Route::get('/mission-suivis/{missionSuivi}',[MissionSuiviController::class, 'show'])->middleware('permission:missions.view');
        Route::put('/mission-suivis/{missionSuivi}',[MissionSuiviController::class, 'update'])->middleware('permission:missions.update');
        Route::patch('/mission-suivis/{missionSuivi}',[MissionSuiviController::class, 'update'])->middleware('permission:missions.update');
        Route::delete('/mission-suivis/{missionSuivi}',[MissionSuiviController::class, 'destroy'])->middleware('permission:missions.delete');

        // Agents
        Route::get('/agents',[AgentController::class, 'index'])->middleware('permission:agents.view');
        Route::post('/agents',[AgentController::class, 'store'])->middleware('permission:agents.create');
        Route::get('/agents/{agent}',[AgentController::class, 'show'])->middleware('permission:agents.view');
        Route::put('/agents/{agent}',[AgentController::class, 'update'])->middleware('permission:agents.update');
        Route::patch('/agents/{agent}',[AgentController::class, 'update'])->middleware('permission:agents.update');
        Route::delete('/agents/{agent}',[AgentController::class, 'destroy'])->middleware('permission:agents.delete');

        // Délégations régionales
        Route::get('/delegation-regionales',[DelegationRegionaleController::class, 'index'])->middleware('permission:delegations.view');
        Route::post('/delegation-regionales',[DelegationRegionaleController::class, 'store'])->middleware('permission:delegations.create');
        Route::get('/delegation-regionales/{delegationRegionale}',[DelegationRegionaleController::class, 'show'])->middleware('permission:delegations.view');
        Route::put('/delegation-regionales/{delegationRegionale}',[DelegationRegionaleController::class, 'update'])->middleware('permission:delegations.update');
        Route::patch('/delegation-regionales/{delegationRegionale}',[DelegationRegionaleController::class, 'update'])->middleware('permission:delegations.update');
        Route::delete('/delegation-regionales/{delegationRegionale}',[DelegationRegionaleController::class, 'destroy'])->middleware('permission:delegations.delete');
        
        // Départements
        Route::get('/departements',[DepartementController::class, 'index'])->middleware('permission:departements.view');
        Route::post('/departements',[DepartementController::class, 'store'])->middleware('permission:departements.create');
        Route::get('/departements/{departement}',[DepartementController::class, 'show'])->middleware('permission:departements.view');
        Route::put('/departements/{departement}',[DepartementController::class, 'update'])->middleware('permission:departements.update');
        Route::patch('/departements/{departement}',[DepartementController::class, 'update'])->middleware('permission:departements.update');
        Route::delete('/departements/{departement}',[DepartementController::class, 'destroy'])->middleware('permission:departements.delete');

        // Sous-préfectures
        Route::get('/sous-prefectures',[SousPrefectureController::class, 'index'])->middleware('permission:sous_prefectures.view');
        Route::post('/sous-prefectures',[SousPrefectureController::class, 'store'])->middleware('permission:sous_prefectures.create');
        Route::get('/sous-prefectures/{sousPrefecture}',[SousPrefectureController::class, 'show'])->middleware('permission:sous_prefectures.view');
        Route::put('/sous-prefectures/{sousPrefecture}',[SousPrefectureController::class, 'update'])->middleware('permission:sous_prefectures.update');
        Route::patch('/sous-prefectures/{sousPrefecture}',[SousPrefectureController::class, 'update'])->middleware('permission:sous_prefectures.update');
        Route::delete('/sous-prefectures/{sousPrefecture}',[SousPrefectureController::class, 'destroy'])->middleware('permission:sous_prefectures.delete');

        // Localités
        Route::get('/localites',[LocaliteController::class, 'index'])->middleware('permission:localites.view');
        Route::post('/localites',[LocaliteController::class, 'store'])->middleware('permission:localites.create');
        Route::get('/localites/{localite}',[LocaliteController::class, 'show'])->middleware('permission:localites.view');
        Route::put('/localites/{localite}',[LocaliteController::class, 'update'])->middleware('permission:localites.update');
        Route::patch('/localites/{localite}',[LocaliteController::class, 'update'])->middleware('permission:localites.update');
        Route::delete('/localites/{localite}',[LocaliteController::class, 'destroy'])->middleware('permission:localites.delete');

    // PRODUCTEURS ---------------------------------------------------------
    Route::get('/producteurs', [ProducteurController::class, 'index'])->middleware('permission:recensement.view|gestion_litiges.view|commercialisation.view|distribution_cartes.view|suivi_producteur.view|users.manage');
    Route::post('/producteurs', [ProducteurController::class, 'store'])->middleware('permission:recensement.create|gestion_litiges.create|users.manage');
    Route::get('/producteurs/{producteur}', [ProducteurController::class, 'show'])->middleware('permission:recensement.view|gestion_litiges.view|commercialisation.view|distribution_cartes.view|suivi_producteur.view|users.manage');
    Route::put('/producteurs/{producteur}', [ProducteurController::class, 'update'])->middleware('permission:recensement.update|gestion_litiges.update|users.manage');
    Route::patch('/producteurs/{producteur}', [ProducteurController::class, 'update'])->middleware('permission:recensement.update|gestion_litiges.update|users.manage');
    Route::delete('/producteurs/{producteur}', [ProducteurController::class, 'destroy'])->middleware('permission:recensement.delete|gestion_litiges.delete|users.manage');

    // PARCELLES -----------------------------------------------------------
    Route::get('/parcelles', [ParcelleController::class, 'index'])->middleware('permission:recensement.view|gestion_litiges.view|suivi_producteur.view|users.manage');
    Route::post('/parcelles', [ParcelleController::class, 'store'])->middleware('permission:recensement.create|gestion_litiges.create|users.manage');
    Route::get('/parcelles/{parcelle}', [ParcelleController::class, 'show'])->middleware('permission:recensement.view|gestion_litiges.view|suivi_producteur.view|users.manage');
    Route::put('/parcelles/{parcelle}', [ParcelleController::class, 'update'])->middleware('permission:recensement.update|gestion_litiges.update|users.manage');
    Route::patch('/parcelles/{parcelle}', [ParcelleController::class, 'update'])->middleware('permission:recensement.update|gestion_litiges.update|users.manage');
    Route::delete('/parcelles/{parcelle}', [ParcelleController::class, 'destroy'])->middleware('permission:recensement.delete|gestion_litiges.delete|users.manage');

    //RELATIONS / RECHERCHES -----------------------------------------------

    Route::get('/producteurs/{id}/parcelles', [ParcelleController::class, 'getByProducteur'])->middleware('permission:recensement.view|gestion_litiges.view|suivi_producteur.view|users.manage');
    Route::get('/operateurs/{id}/magasins', [MagasinController::class, 'getByOperateur'])->middleware('permission:codification.view|commercialisation.view|users.manage');
    Route::get('/departements/delegation/{id}', [DepartementController::class, 'parDelegation'])->middleware('permission:departements.view');
    Route::get('/sous-prefectures/departement/{id}', [SousPrefectureController::class, 'parDepartement'])->middleware('permission:sous_prefectures.view');
    Route::get('/localites/sous-prefecture/{id}', [LocaliteController::class, 'parSousPrefecture'])->middleware('permission:localites.view');

    //MODULE  OPÉRATION ------------------------------------------------------

    // Opérateurs
    Route::get('/operateurs', [OperateurController::class, 'index'])->middleware('permission:codification.view|commercialisation.view|users.manage');
    Route::post('/operateurs', [OperateurController::class, 'store'])->middleware('permission:codification.create|commercialisation.create|users.manage');
    Route::get('/operateurs/{operateur}', [OperateurController::class, 'show'])->middleware('permission:codification.view|commercialisation.view|users.manage');
    Route::put('/operateurs/{operateur}', [OperateurController::class, 'update'])->middleware('permission:codification.update|commercialisation.update|users.manage');
    Route::patch('/operateurs/{operateur}', [OperateurController::class, 'update'])->middleware('permission:codification.update|commercialisation.update|users.manage');
    Route::delete('/operateurs/{operateur}', [OperateurController::class, 'destroy'])->middleware('permission:codification.delete|commercialisation.delete|users.manage');

    // Magasins
    Route::get('/magasins', [MagasinController::class, 'index'])->middleware('permission:codification.view|commercialisation.view|users.manage');
    Route::post('/magasins', [MagasinController::class, 'store'])->middleware('permission:codification.create|commercialisation.create|users.manage');
    Route::get('/magasins/{magasin}', [MagasinController::class, 'show'])->middleware('permission:codification.view|commercialisation.view|users.manage');
    Route::put('/magasins/{magasin}', [MagasinController::class, 'update'])->middleware('permission:codification.update|commercialisation.update|users.manage');
    Route::patch('/magasins/{magasin}', [MagasinController::class, 'update'])->middleware('permission:codification.update|commercialisation.update|users.manage');
    Route::delete('/magasins/{magasin}', [MagasinController::class, 'destroy'])->middleware('permission:codification.delete|commercialisation.delete|users.manage');

    // Ayants-droits
    Route::get('/ayants-droits', [AyantDroitController::class, 'index'])->middleware('permission:gestion_litiges.view|users.manage');
    Route::post('/ayants-droits', [AyantDroitController::class, 'store'])->middleware('permission:gestion_litiges.create|users.manage');
    Route::get('/ayants-droits/{ayantDroit}', [AyantDroitController::class, 'show'])->middleware('permission:gestion_litiges.view|users.manage');
    Route::put('/ayants-droits/{ayantDroit}', [AyantDroitController::class, 'update'])->middleware('permission:gestion_litiges.update|users.manage');
    Route::patch('/ayants-droits/{ayantDroit}', [AyantDroitController::class, 'update'])->middleware('permission:gestion_litiges.update|users.manage');
    Route::delete('/ayants-droits/{ayantDroit}', [AyantDroitController::class, 'destroy'])->middleware('permission:gestion_litiges.delete|users.manage');

    // Ayant-droit-parcelles
    Route::get('/ayant-droit-parcelles', [AyantDroitParcelleController::class, 'index'])->middleware('permission:gestion_litiges.view|users.manage');
    Route::post('/ayant-droit-parcelles', [AyantDroitParcelleController::class, 'store'])->middleware('permission:gestion_litiges.create|users.manage');
    Route::get('/ayant-droit-parcelles/{ayantDroitParcelle}', [AyantDroitParcelleController::class, 'show'])->middleware('permission:gestion_litiges.view|users.manage');
    Route::put('/ayant-droit-parcelles/{ayantDroitParcelle}', [AyantDroitParcelleController::class, 'update'])->middleware('permission:gestion_litiges.update|users.manage');
    Route::patch('/ayant-droit-parcelles/{ayantDroitParcelle}', [AyantDroitParcelleController::class, 'update'])->middleware('permission:gestion_litiges.update|users.manage');
    Route::delete('/ayant-droit-parcelles/{ayantDroitParcelle}', [AyantDroitParcelleController::class, 'destroy'])->middleware('permission:gestion_litiges.delete|users.manage');

    // RECENSEMENT -----------------------------------------------------------
    Route::get('/recensements', [RecensementController::class, 'index'])->middleware('permission:recensement.view');
    Route::post('/recensements', [RecensementController::class, 'store'])->middleware('permission:recensement.create');
    Route::get('/recensements/{recensement}', [RecensementController::class, 'show'])->middleware('permission:recensement.view');
    Route::put('/recensements/{recensement}', [RecensementController::class, 'update'])->middleware('permission:recensement.update');
    Route::patch('/recensements/{recensement}', [RecensementController::class, 'update'])->middleware('permission:recensement.update');
    Route::delete('/recensements/{recensement}', [RecensementController::class, 'destroy'])->middleware('permission:recensement.delete');

    // CODIFICATION -----------------------------------------------------------
    Route::get('/codification-operateurs', [SuiviCodificationOperateurController::class, 'index'])->middleware('permission:codification.view');
    Route::post('/codification-operateurs', [SuiviCodificationOperateurController::class, 'store'])->middleware('permission:codification.create');
    Route::get('/codification-operateurs/{suiviCodificationOperateur}', [SuiviCodificationOperateurController::class, 'show'])->middleware('permission:codification.view');
    Route::put('/codification-operateurs/{suiviCodificationOperateur}', [SuiviCodificationOperateurController::class, 'update'])->middleware('permission:codification.update');
    Route::patch('/codification-operateurs/{suiviCodificationOperateur}', [SuiviCodificationOperateurController::class, 'update'])->middleware('permission:codification.update');
    Route::delete('/codification-operateurs/{suiviCodificationOperateur}', [SuiviCodificationOperateurController::class, 'destroy'])->middleware('permission:codification.delete');

    //RÔLES --------------------------------------------------------------------

    Route::patch('/roles/{role}/statut',[RoleController::class, 'toggleActif'])->middleware('permission:roles.manage');
    Route::get('/roles/{role}/permissions',[RoleController::class, 'permissions'])->middleware('permission:roles.manage');
    Route::put('/roles/{role}/permissions',[RoleController::class, 'syncPermissions'])->middleware('permission:roles.manage');
    Route::get('/roles/{role}/users',[RoleController::class, 'users'])->middleware('permission:roles.manage');
    Route::get('/roles',[RoleController::class, 'index'])->middleware('permission:roles.manage');
    Route::post('/roles',[RoleController::class, 'store'])->middleware('permission:roles.manage');
    Route::get('/roles/{role}',[RoleController::class, 'show'])->middleware('permission:roles.manage');
    Route::put('/roles/{role}',[RoleController::class, 'update'])->middleware('permission:roles.manage');
    Route::patch('/roles/{role}',[RoleController::class, 'update'])->middleware('permission:roles.manage');
    Route::delete('/roles/{role}',[RoleController::class, 'destroy'])->middleware('permission:roles.manage');

    //PERMISSIONS ------------------------------------------------------------------

    Route::patch('/permissions/{permission}/statut',[PermissionController::class, 'toggleActif'])->middleware('permission:permissions.manage');
    Route::get('/permissions',[PermissionController::class, 'index'])->middleware('permission:permissions.manage');
    Route::post('/permissions',[PermissionController::class, 'store'])->middleware('permission:permissions.manage');
    Route::get('/permissions/{permission}',[PermissionController::class, 'show'])->middleware('permission:permissions.manage');
    Route::put('/permissions/{permission}',[PermissionController::class, 'update'])->middleware('permission:permissions.manage');
    Route::patch('/permissions/{permission}',[PermissionController::class, 'update'])->middleware('permission:permissions.manage');
    Route::delete('/permissions/{permission}',[PermissionController::class, 'destroy'])->middleware('permission:permissions.manage');

  
    // DISTRIBUTION DES CARTES---------------------------------------------------
    
    Route::get('/distribution-cartes',[DistributionCarteController::class, 'index']
    )->middleware('permission:distribution_cartes.view');
    Route::post('/distribution-cartes',[DistributionCarteController::class, 'store']
    )->middleware('permission:distribution_cartes.create');
    Route::get('/distribution-cartes/{distributionCarte}',[DistributionCarteController::class, 'show']
    )->middleware('permission:distribution_cartes.view');
    Route::put('/distribution-cartes/{distributionCarte}',[DistributionCarteController::class, 'update']
    )->middleware('permission:distribution_cartes.update');
    Route::patch('/distribution-cartes/{distributionCarte}',[DistributionCarteController::class, 'update']
    )->middleware('permission:distribution_cartes.update');
    Route::delete('/distribution-cartes/{distributionCarte}',[DistributionCarteController::class, 'destroy']
    )->middleware('permission:distribution_cartes.delete');


    //COMMERCIALISATION---------------------------------------------------------

    Route::get('/suivi-commercialisations',[SuiviCommercialisationController::class, 'index']
    )->middleware('permission:commercialisation.view');
    Route::post('/suivi-commercialisations',[SuiviCommercialisationController::class, 'store']
    )->middleware('permission:commercialisation.create');
    Route::get('/suivi-commercialisations/{suiviCommercialisation}',[SuiviCommercialisationController::class, 'show']
    )->middleware('permission:commercialisation.view');
    Route::put('/suivi-commercialisations/{suiviCommercialisation}',[SuiviCommercialisationController::class, 'update']
    )->middleware('permission:commercialisation.update');
    Route::patch('/suivi-commercialisations/{suiviCommercialisation}',[SuiviCommercialisationController::class, 'update']
    )->middleware('permission:commercialisation.update');
    Route::delete('/suivi-commercialisations/{suiviCommercialisation}',[SuiviCommercialisationController::class, 'destroy']
    )->middleware('permission:commercialisation.delete');


    //GESTION DES LITIGES ----------------------------------------------------------

    Route::get('/gestion-litiges',[GestionLitigeController::class, 'index']
    )->middleware('permission:gestion_litiges.view');
    Route::post('/gestion-litiges',[GestionLitigeController::class, 'store']
    )->middleware('permission:gestion_litiges.create');
    Route::get('/gestion-litiges/{gestionLitige}',[GestionLitigeController::class, 'show']
    )->middleware('permission:gestion_litiges.view');
    Route::put('/gestion-litiges/{gestionLitige}',[GestionLitigeController::class, 'update']
    )->middleware('permission:gestion_litiges.update');
    Route::patch('/gestion-litiges/{gestionLitige}',[GestionLitigeController::class, 'update']
    )->middleware('permission:gestion_litiges.update');
    Route::delete('/gestion-litiges/{gestionLitige}',[GestionLitigeController::class, 'destroy']
    )->middleware('permission:gestion_litiges.delete');

    // GESTION DES OUTILS --------------------------------------------------------

    Route::get('/gestion-outils',[GestionOutilsController::class, 'index']
    )->middleware('permission:gestion_outils.view');
    Route::post('/gestion-outils',[GestionOutilsController::class, 'store']
    )->middleware('permission:gestion_outils.create');
    Route::get('/gestion-outils/{gestionOutil}',[GestionOutilsController::class, 'show']
    )->middleware('permission:gestion_outils.view');
    Route::put('/gestion-outils/{gestionOutil}',[GestionOutilsController::class, 'update']
    )->middleware('permission:gestion_outils.update');
    Route::patch('/gestion-outils/{gestionOutil}',[GestionOutilsController::class, 'update']
    )->middleware('permission:gestion_outils.update');
    Route::delete('/gestion-outils/{gestionOutil}',[GestionOutilsController::class, 'destroy']
    )->middleware('permission:gestion_outils.delete');


    //SUIVI PRODUCTEUR
   
    Route::get('/suivi-utilisation-producteurs',[SuiviUtilisationProducteurController::class, 'index']
    )->middleware('permission:suivi_producteur.view');
    Route::post('/suivi-utilisation-producteurs',[SuiviUtilisationProducteurController::class, 'store']
    )->middleware('permission:suivi_producteur.create');
    Route::get('/suivi-utilisation-producteurs/{suiviUtilisationProducteur}',[SuiviUtilisationProducteurController::class, 'show']
    )->middleware('permission:suivi_producteur.view');
    Route::put('/suivi-utilisation-producteurs/{suiviUtilisationProducteur}',[SuiviUtilisationProducteurController::class, 'update']
    )->middleware('permission:suivi_producteur.update');
    Route::patch('/suivi-utilisation-producteurs/{suiviUtilisationProducteur}',[SuiviUtilisationProducteurController::class, 'update']
    )->middleware('permission:suivi_producteur.update');
    Route::delete('/suivi-utilisation-producteurs/{suiviUtilisationProducteur}',[SuiviUtilisationProducteurController::class, 'destroy']
    )->middleware('permission:suivi_producteur.delete');


    //UTILISATEURS -----------------------------------------------------------------

    Route::get('/users',[UserController::class, 'index'])->middleware('permission:users.manage');
    Route::post('/users',[UserController::class, 'store'])->middleware('permission:users.manage');
    Route::get('/users/disponibles', [UserController::class, 'disponibles']
    )->middleware('permission:users.manage|agents.create|agents.update');
    Route::get('/users/{user}',[UserController::class, 'show'])->middleware('permission:users.manage');
    Route::put('/users/{user}',[UserController::class, 'update'])->middleware('permission:users.manage');
    Route::patch('/users/{user}',[UserController::class, 'update'])->middleware('permission:users.manage');
    Route::delete('/users/{user}',[UserController::class, 'destroy'])->middleware('permission:users.manage');

    Route::patch('/users/{user}/statut',[UserController::class, 'toggleActif']
    )->middleware('permission:users.manage');
    Route::get('/users/{user}/roles',[UserController::class, 'roles']
    )->middleware('permission:users.manage');
    Route::put('/users/{user}/roles',[UserController::class, 'syncRoles']
    )->middleware('permission:users.manage');




});


