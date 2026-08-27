<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Agent;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //
        $query = User::query();

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


    public function store(Request $request)
    {
        $validated = $request->validate([

            'matricule' => ['required','string','max:100','unique:users,matricule'],
            'nom' => ['required','string','max:100'],
            'prenoms' => ['required','string','max:150'],
            'email' => ['required','email','max:255','unique:users,email'],
            'telephone' => ['nullable','string','max:30'],
            'fonction' => ['nullable','string','max:150'],
            'password' => ['required','string','min:8'],
            'actif' => ['boolean'],
        ]);


        $validated['password'] =
            Hash::make($validated['password']);
        $user = User::create($validated);

        return response()->json(
            $user,
            201
        );
    }


    public function show(User $user)
    {
        return response()->json(
            $user
        );
    }


    public function update(Request $request,User $user) 
    {

        $validated = $request->validate([

            'matricule' => [
                'required',
                'string',
                'max:100',
                Rule::unique('users', 'matricule')
                    ->ignore($user->id)
            ],

            'nom' => [
                'required',
                'string',
                'max:100'
            ],

            'prenoms' => [
                'required',
                'string',
                'max:150'
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($user->id)
            ],

            'telephone' => [
                'nullable',
                'string',
                'max:30'
            ],

            'fonction' => [
                'nullable',
                'string',
                'max:150'
            ],

            'actif' => [
                'boolean'
            ],

        ]);


        $user->update($validated);


        return response()->json(
            $user
        );
    }


    public function destroy(User $user)
    {
        $user->delete();


        return response()->json([
            'message' => 'Utilisateur supprimé avec succès.'
        ]);
    }

    public function toggleActif(Request $request, User $user)
    {
        $request->validate([
            'actif' => ['required', 'boolean'],
        ]);

        $user->update([
            'actif' => $request->boolean('actif'),
        ]);

        return response()->json([
            'message' => $user->actif
                ? 'Utilisateur activé avec succès.'
                : 'Utilisateur désactivé avec succès.',
            'user' => $user,
        ]);
    }

    public function roles(User $user)
    {
        return response()->json(
            $user->roles()->get()
        );
    }

    public function syncRoles(Request $request, User $user)
    {
        $validated = $request->validate([
            'role_ids' => ['required', 'array'],
            'role_ids.*' => ['integer', 'exists:roles,id'],
        ]);

        $user->roles()->sync(
            $validated['role_ids']
        );

        return response()->json([
            'message' => 'Rôles de l’utilisateur mis à jour avec succès.',
            'roles' => $user->roles()->get(),
        ]);
    }

    public function disponibles()
        {
            return response()->json(
                User::where('actif', true)
                    ->orderBy('nom')
                    ->orderBy('prenoms')
                    ->get()
            );
        }

    
}