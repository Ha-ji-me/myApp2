<?php

namespace App\Policies;

use App\Models\IncidentPost;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IncidentPostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\IncidentPost  $incidentPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, IncidentPost $incidentPost)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\IncidentPost  $incidentPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, IncidentPost $incidentPost)
    {
        return $user->id === $incidentPost->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\IncidentPost  $incidentPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, IncidentPost $incidentPost)
    {
        //作成者は削除可能
        if ($user->id === $incidentPost->user_id) {
            return true;
        }
        //管理者は削除可能
        foreach ($user->roles as $role) {
            if ($role->name === 'admin') {
                return true;
            }
        }
        //その他の場合 削除不可能
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\IncidentPost  $incidentPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, IncidentPost $incidentPost)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\IncidentPost  $incidentPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, IncidentPost $incidentPost)
    {
        //
    }
}
