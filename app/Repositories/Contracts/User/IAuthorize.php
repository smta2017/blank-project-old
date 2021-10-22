<?php

namespace App\Repositories\Contracts\User;

use App\Repositories\Contracts\IBase;

/**
 * Interface IAuth
 */
interface IAuthorize extends IBase
{
    
    public function roles();

    public function permissions();

    public function createPermission($name);

    public function createRole($name);

    public function assignRoleToPermission($request);

    public function rolePermissions($role_id);

    public function assignRoleToUser($request);

    public function userPermissions($user_id);

    public function revoke($request);

}
