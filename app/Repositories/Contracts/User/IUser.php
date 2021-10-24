<?php

namespace App\Repositories\Contracts\User;

use App\Repositories\Contracts\IBase;
use Illuminate\Http\Request;

/**
 * Interface IAuth
 */
interface IUser extends IBase
{

    public function userProfile($id);
    public function allUsers();
    public function createUser(Request $request);
    public function updateUser(Request $request,$id);
    public function deleteUser($id);

}
