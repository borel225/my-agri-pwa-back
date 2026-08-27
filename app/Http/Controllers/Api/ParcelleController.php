<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreParcelleRequest;
use App\Models\Parcelle;
use Illuminate\Http\Request;

class ParcelleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Parcelle::with([
            'producteur',
            'localite'
        ])
        ->orderBy('code_parcelle')
        ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreParcelleRequest $request)
    {
        //
         $parcelle = Parcelle::create(
            $request->validated()
        );

        return response()->json($parcelle, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Parcelle $parcelle)
    {
        //
         return $parcelle->load([
            'producteur',
            'localite'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreParcelleRequest $request, Parcelle $parcelle)
    {
        //
        $parcelle->update(
            $request->validated()
        );

        return response()->json($parcelle);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parcelle $parcelle)
    {
        //
        $parcelle->delete();

        return response()->json([
            'message'=>'Parcelle supprimée avec succès'
        ]);
    }

    public function getByProducteur($id)
    {
        return Parcelle::with(['localite'])
                        ->where('producteur_id', $id)
                        ->orderBy('code_parcelle')
                        ->get();
    }
}
