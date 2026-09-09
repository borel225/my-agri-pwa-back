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

            // Filtre par département si fourni
            if ($request->filled('departement_id')) {
                $query->where('departement_id', $request->departement_id);
            }

            // Si demande de tout récupérer sans pagination
            if ($request->boolean('all') || $request->input('per_page') === 'all') {
                return response()->json($query->orderBy('nom')->get());
            }

            // Nombre par page
            $perPage = $request->integer('per_page',10);

            // Protection : jusqu'à 1000 éléments
            $perPage = min(max($perPage, 1), 1000);

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