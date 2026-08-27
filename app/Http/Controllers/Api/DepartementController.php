<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartementRequest;
use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $query = departement::with(
            'delegationRegionale');

            // Recherche
            if ($request->filled('search')) {
                $query->where('nom','ILIKE','%' . $request->search . '%');
            }

            // Nombre par page
            $perPage = $request->integer('per_page',10);

            // Protection
            $perPage = min(max($perPage, 5),100);

            return $query->orderBy('nom')->paginate($perPage);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartementRequest $request)
    {
        //
        $departement = Departement::create(
            $request->validated()
        );

        return response()->json($departement, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Departement $departement)
    {
        //
        return $departement->load('delegationRegionale');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDepartementRequest $request, Departement $departement)
    {
        //
        $departement->update(
            $request->validated()
        );

        return response()->json($departement);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departement $departement)
    {
        //
         $departement->delete();

        return response()->json([
            'message'=>'Département supprimé'
        ]);
    }

    public function parDelegation($delegationId)
    {
        return Departement::where('delegation_regionale_id',$delegationId)
                            ->orderBy('nom')
                            ->get();
    }
}
