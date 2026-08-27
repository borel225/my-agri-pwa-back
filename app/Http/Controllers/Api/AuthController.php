<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'email'
            ],

            'password' => [
                'required',
                'string'
            ],
        ]);


        $user = User::where(
            'email',
            $credentials['email']
        )->first();


        if (
            !$user ||
            !Hash::check(
                $credentials['password'],
                $user->password
            )
        ) {

            return response()->json([
                'message' => 'Email ou mot de passe incorrect.'
            ], 401);

        }


        if (!$user->actif) {

            return response()->json([
                'message' => 'Votre compte est désactivé.'
            ], 403);

        }


        $token = $user->createToken(
            'my-agri-pwa'
        )->plainTextToken;


        return response()->json([

            'message' => 'Connexion réussie.',

            'user' => $user,

            'token' => $token,

        ]);

    }


    public function me(Request $request)
    {
            $user = $request->user()->load([
            'roles.permissions'
        ]);

        $permissions = $user->roles
            ->where('actif', true)
            ->flatMap(function ($role) {

                return $role->permissions
                    ->where('actif', true);

            })
            ->unique('id')
            ->values();

        return response()->json([
            'id' => $user->id,
            'matricule' => $user->matricule,
            'nom' => $user->nom,
            'prenoms' => $user->prenoms,
            'email' => $user->email,
            'telephone' => $user->telephone,
            'fonction' => $user->fonction,
            'actif' => $user->actif,

            'roles' => $user->roles,

            'permissions' => $permissions
                ->pluck('code')
                ->values(),
        ]);
    }


    public function logout(Request $request)
    {
        $request
            ->user()
            ->currentAccessToken()
            ->delete();


        return response()->json([
            'message' => 'Déconnexion réussie.'
        ]);
    }

        public function changePassword(Request $request)
    {
        $request->validate([
            'ancien_password' => ['required', 'string'],
            'nouveau_password' => ['required', 'string', 'min:8'],
            'confirmation_password' => ['required', 'same:nouveau_password'],
        ]);

        $user = $request->user();

        if (!Hash::check(
            $request->ancien_password,
            $user->password
        )) {
            return response()->json([
                'message' => 'L’ancien mot de passe est incorrect.'
            ], 422);
        }

        $user->password = $request->nouveau_password;

        $user->save();

        return response()->json([
            'message' => 'Mot de passe modifié avec succès.'
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:100'],
            'prenoms' => ['required', 'string', 'max:150'],
            'email' => [
                'required',
                'email',
                'max:150',
                'unique:users,email,' . $user->id,
            ],
            'telephone' => ['nullable', 'string', 'max:30'],
            'fonction' => ['nullable', 'string', 'max:150'],
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'Profil modifié avec succès.',
            'user' => $user->fresh(),
        ]);
    }
}