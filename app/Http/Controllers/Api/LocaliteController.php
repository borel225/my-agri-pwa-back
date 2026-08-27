<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocaliteRequest;
use App\Models\Localite;
use Illuminate\Http\Request;

class LocaliteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Localite::with('sousPrefecture.departement.delegationRegionale');

        // Recherche par nom de localité
        if ($request->filled('search')) {
            $query->where('nom','ILIKE','%' . $request->search . '%');
        }

        // Filtre par sous-préfecture
        if ($request->filled('sous_prefecture_id')) {

            $query->where(
                'sous_prefecture_id',
                $request->sous_prefecture_id
            );
        }

        // Nombre d'éléments par page
        $perPage = $request->integer('per_page', 10);

        // Protection : minimum 5, maximum 100
        $perPage = min(
            max($perPage, 5),
            100
        );

        return $query
            ->orderBy('nom')
            ->paginate($perPage);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocaliteRequest $request)
    {
        //
        $localite = Localite::create(
            $request->validated()
        );


        return response()->json($localite, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Localite $localite)
    {
        //
            return $localite->load(['sousPrefecture.departement.delegationRegionale']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreLocaliteRequest $request, Localite $localite)
    {
        //
        $localite->update(
            $request->validated()
        );

        return response()->json($localite);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Localite $localite)
    {
        //
        $localite->delete();

        return response()->json([
            'message'=>'Localité supprimé'
        ]);
    }

    public function parSousPrefecture($sousPrefectureId)
    {
        return Localite::where('sous_prefecture_id',$sousPrefectureId)
                            ->orderBy('nom')
                            ->get();
    }
}
