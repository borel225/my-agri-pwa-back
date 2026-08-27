<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAgentRequest;
use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Agent::with(['delegationRegionale','utilisateur']);
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
    public function store(StoreAgentRequest $request)
    {
        //
        $agent = Agent::create(
            $request->validated()
        );

        return response()->json($agent, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Agent $agent)
    {
        //
          return $agent->load(['delegationRegionale','utilisateur.roles']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAgentRequest $request, Agent $agent)
    {
        //
         $agent->update(
            $request->validated()
        );

        return response()->json($agent);
    }

    /**
     * Remove the specified resource from storage.
        */
        public function destroy(Agent $agent)
    {
        $agent->delete();

        return response()->json([
            'message'=>'Agent supprimé avec succès'
        ]);
    }
}
