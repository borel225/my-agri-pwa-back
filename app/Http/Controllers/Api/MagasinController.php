<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMagasinRequest;
use App\Models\Magasin;
use Illuminate\Http\Request;

class MagasinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         return Magasin::with('operateur')
            ->orderBy('code_magasin')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMagasinRequest $request)
    {
        //
        $magasin = Magasin::create(
            $request->validated()
        );

        return response()->json($magasin, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Magasin $magasin)
    {
        //
         return $magasin->load('operateur');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( StoreMagasinRequest $request,
        Magasin $magasin)
    {
        //
        $magasin->update(
            $request->validated()
        );

        return response()->json($magasin);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Magasin $magasin)
    {
        //
         $magasin->delete();

        return response()->json([
            'message' => 'Magasin supprimé avec succès'
        ]);
    }

    public function getByOperateur($id)
    {
        return Magasin::where('operateur_id',$id
        )->get();
    }
}
