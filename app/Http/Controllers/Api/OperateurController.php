<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOperateurRequest;
use App\Models\Operateur;
use Illuminate\Http\Request;

class OperateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Operateur::with('departement')
            ->orderBy('sigle_operateur')
            ->get();
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOperateurRequest $request)
    {
        //
        $operateur = Operateur::create(
            $request->validated()
        );

        return response()->json($operateur,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Operateur $operateur)
    {
        //
        return $operateur->load('departement');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOperateurRequest $request,
        Operateur $operateur)
    {
        //

        $operateur->update(
            $request->validated()
        );

        return response()->json($operateur);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Operateur $operateur)
    {
        //
        $operateur->delete();

        return response()->json([
            'message'=>'Opérateur supprimé avec succès'
        ]);
    }
}
