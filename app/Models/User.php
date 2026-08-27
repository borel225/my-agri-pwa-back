<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Agent;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

     protected $fillable = [
        'matricule',
        'nom',
        'prenoms',
        'email',
        'telephone',
        'fonction',
        'password',
        'actif',
    ];

     protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'actif' => 'boolean',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_user');
    }

    public function hasPermission(string $permission): bool
    {
        return $this->roles()
            ->where('actif', true)
            ->whereHas('permissions', function ($query) use ($permission) {
                $query->where('code', $permission)
                    ->where('actif', true);
            })
            ->exists();
    }

    public function hasAnyPermission(array $permissions): bool
    {
        foreach ($permissions as $permission) {

            if ($this->hasPermission($permission)) {
                return true;
            }

        }

        return false;
    }

    public function agent()
    {
        return $this->hasOne(
            Agent::class,
            'utilisateur_id'
        );
    }

}
