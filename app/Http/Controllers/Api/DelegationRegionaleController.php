<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDelegationRegionaleRequest;
use App\Models\DelegationRegionale;
use Illuminate\Http\Request;

class DelegationRegionaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
            $query = DelegationRegionale::query();

        // Recherche par nom
        if ($request->filled('search')) {
            $query->where('nom','ILIKE','%' . $request->search . '%');
        }

        // Nombre d'éléments par page
        $perPage = $request->integer('per_page', 10);

        // Protection
        $perPage = min(max($perPage, 5),100);

        return $query->orderBy('nom')->paginate($perPage);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDelegationRegionaleRequest $request)
    {
        //
         $delegation = DelegationRegionale::create(
            $request->validated()
        );

        return response()->json($delegation, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(DelegationRegionale $delegationRegionale)
    {
        //
        return $delegationRegionale;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDelegationRegionaleRequest $request, DelegationRegionale $delegationRegionale)
    {
        //
         $delegationRegionale->update(
            $request->validated()
        );

        return response()->json($delegationRegionale);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DelegationRegionale $delegationRegionale)
    {
        //
        $delegationRegionale->delete();

        return response()->json([
            'message' => 'Délégation supprimée'
        ]);
    }
}
