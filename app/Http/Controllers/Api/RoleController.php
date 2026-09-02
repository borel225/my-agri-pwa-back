<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Role::withCount('users')
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:100'],
            'code' => ['required', 'string', 'max:50', 'unique:roles,code'],
            'description' => ['nullable', 'string'],
            'actif' => ['nullable', 'boolean'],
        ]);

        $role = Role::create($validated);

        return response()->json(
            $role->loadCount('users'),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return $role->load(['users', 'permissions'])->loadCount('users');   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:100'],

            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('roles', 'code')
                    ->ignore($role->id),
            ],

            'description' => ['nullable', 'string'],
            'actif' => ['nullable', 'boolean'],
        ]);

        $role->update($validated);

        return response()->json(
            $role->loadCount('users')
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
        $role->delete();

        return response()->json([
            'message' => 'Rôle supprimé avec succès.'
        ]);
    }

    public function toggleActif(Request $request, Role $role)
    {
        $validated = $request->validate([
            'actif' => ['required', 'boolean'],
        ]);

        $role->update([
            'actif' => $validated['actif'],
        ]);

        return response()->json([
            'message' => $role->actif
                ? 'Rôle activé avec succès.'
                : 'Rôle désactivé avec succès.',
            'role' => $role,
        ]);
    }

    public function permissions(Role $role)
    {
            return response()->json(
                $role->permissions()->get()
            );
        }

        public function syncPermissions(
        Request $request,
        Role $role
    ) {
        $validated = $request->validate([
            'permission_ids' => ['required', 'array'],
            'permission_ids.*' => [
                'integer',
                'exists:permissions,id'
            ],
        ]);

        $role->permissions()->sync(
            $validated['permission_ids']
        );

        return response()->json([
            'message' =>
                'Permissions du rôle mises à jour avec succès.',

            'permissions' =>
                $role->permissions()->get(),
        ]);
    }

    public function users(Role $role)
    {
        return response()->json($role->users);
    }
}
