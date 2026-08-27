<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSousPrefectureRequest;
use App\Models\SousPrefecture;
use Illuminate\Http\Request;

class SousPrefectureController extends Controller
{
    public function index(Request $request)
    {
            $query = SousPrefecture::with(
            'departement.delegationRegionale');

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

    public function store(StoreSousPrefectureRequest $request)
    {
        $sousPrefecture = SousPrefecture::create(
            $request->validated()
        );

        return response()->json($sousPrefecture, 201);
    }

    public function show(SousPrefecture $sousPrefecture)
    {
            return $sousPrefecture->load([
            'departement.delegationRegionale'
        ]);
    }

    public function update(StoreSousPrefectureRequest $request, SousPrefecture $sousPrefecture)
    {
        $sousPrefecture->update($request->validated());

        return response()->json($sousPrefecture);
    }

    public function destroy(SousPrefecture $sousPrefecture)
    {
        $sousPrefecture->delete();

        return response()->json([
            'message' => 'Sous-préfecture supprimée'
        ]);
    }

    public function parDepartement($departementId)
    {
        return SousPrefecture::where('departement_id',$departementId)
                                ->orderBy('nom')
                                ->get();
    }
}