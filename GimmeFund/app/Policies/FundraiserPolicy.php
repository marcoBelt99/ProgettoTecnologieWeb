<?php

namespace App\Policies;

use App\Fundraiser;
use App\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class FundraiserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Fundraiser  $fundraiser
     * @return mixed
     */
    public function view(User $user, Fundraiser $fundraiser)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if (auth()->user()->hasRole('user')) {
            return true;
        }    
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Fundraiser  $fundraiser
     * @return mixed
     */
    public function update(User $user, Fundraiser $fundraiser)
    {
        if (auth()->user()->id === $fundraiser->user_id) {
            return true;
        }    
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Fundraiser  $fundraiser
     * @return mixed
     */
    public function delete(User $user, Fundraiser $fundraiser)
    {
        if (auth()->user()->id === $fundraiser->user_id) {
            return true;
        }    
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Fundraiser  $fundraiser
     * @return mixed
     */
    public function restore(User $user, Fundraiser $fundraiser)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Fundraiser  $fundraiser
     * @return mixed
     */
    public function forceDelete(User $user, Fundraiser $fundraiser)
    {
        //
    }
}
