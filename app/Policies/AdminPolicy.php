<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;
    
    /**
     * Viewing Policy, can access admin
     *
     * @param User $user Model for registered user
     *
     * @return boolean
     */
    public function view(User $user)
    {
        if ($this->_role($user)) {
            return true;
        }

        return false;
    }
    
    /**
     * Checks Role
     *
     * @param User $user Model for registered user
     *
     * @return boolean
     */
    private function _role(User $user)
    {
        return $user->role == config('const.roles.key')['Admin'];
    }
}
