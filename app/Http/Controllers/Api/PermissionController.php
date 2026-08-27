<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Permission::withCount('roles')
            ->orderBy('module')
            ->orderBy('action')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:150'],
            'code' => ['required', 'string', 'max:100', 'unique:permissions,code'],
            'module' => ['required', 'string', 'max:100'],
            'action' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'actif' => ['nullable', 'boolean'],
        ]);

        $permission = Permission::create($validated);

        return response()->json(
            $permission->loadCount('roles'),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
         return $permission->loadCount('roles');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,
        Permission $permission)
    {
        //
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:150'],
            'code' => ['required','string','max:100',
            
            Rule::unique('permissions', 'code')->ignore($permission->id),],

            'module' => ['required', 'string', 'max:100'],
            'action' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'actif' => ['nullable', 'boolean'],
        ]);

        $permission->update($validated);
        return response()->json($permission->loadCount('roles'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        //
        if ($permission->roles()->exists()) {
            return response()->json([
                'message' =>
                    'Impossible de supprimer cette permission car elle est attribuée à un ou plusieurs rôles.'
            ], 422);
        }

        $permission->delete();

        return response()->json([
            'message' => 'Permission supprimée avec succès.'
        ]); 
    }

    public function toggleActif(
        Request $request,
        Permission $permission
    ) {
        $validated = $request->validate([
            'actif' => ['required', 'boolean'],
        ]);

        $permission->update([
            'actif' => $validated['actif'],
        ]);

        return response()->json([
            'message' => $permission->actif
                ? 'Permission activée avec succès.'
                : 'Permission désactivée avec succès.',
            'permission' => $permission,
        ]);
    }
}
