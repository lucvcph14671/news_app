<?php

namespace App\Policies;

use App\Models\post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, post $post)
    {
        return $user->id == $post->id_user;
    }
}
