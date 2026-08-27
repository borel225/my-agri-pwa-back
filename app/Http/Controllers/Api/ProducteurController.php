<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProducteurRequest;
use App\Models\Producteur;
use Illuminate\Http\Request;

class ProducteurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $search = $request->search;

    $query = Producteur::query();

    if ($search) {

        $query->where('code_producteur', 'like', "%{$search}%")
                ->orWhere('nom', 'like', "%{$search}%")
                ->orWhere('prenoms', 'like', "%{$search}%")
                ->orWhere('contact', 'like', "%{$search}%");

    }

    return $query
            ->orderBy('nom')
            ->limit(20)
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProducteurRequest $request)
    {
        //

       $producteur = Producteur::create(
            $request->validated()
        );

        return response()->json($producteur, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Producteur $producteur)
    {
        //
       return $producteur->load('parcelles');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProducteurRequest $request, Producteur $producteur)
    {
        //
          $producteur->update(
            $request->validated()
        );

        return response()->json($producteur);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producteur $producteur)
    {
        //
        $producteur->delete();

        return response()->json([
            'message'=>'Producteur supprimé avec succès'
        ]);
    }
}
