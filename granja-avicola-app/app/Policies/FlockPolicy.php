<?php

namespace App\Policies;

use App\Models\Flock;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FlockPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @return bool|null
     */
    public function before(User $user, string $ability): bool|null
    {
        // El administrador tiene todos los permisos.
        if ($user->role === 'admin') {
            return true;
        }

        return null; // Dejar que la política específica decida
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Cualquier usuario autenticado puede ver la lista de lotes.
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Flock $flock): bool
    {
        // Cualquier usuario autenticado puede ver el detalle de un lote.
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Solo los administradores pueden crear (manejado por el método before).
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Flock $flock): bool
    {
        // Solo los administradores pueden actualizar (manejado por el método before).
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Flock $flock): bool
    {
        // Solo los administradores pueden eliminar (manejado por el método before).
        return false;
    }
}
