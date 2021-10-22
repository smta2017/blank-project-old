<?php

namespace App\Http\Controllers\Api\Authorize;

use App\Http\Controllers\Controller;
use App\Http\Traits\SMSTrait;
use App\Repositories\Contracts\User\IAuthorize;
use Illuminate\Http\Request;

class AuthorizeController extends Controller
{
    use SMSTrait;
    public $authorizeRepo;

    public function send()
    {
      return  $this->sendSms('01274200778', 'lol');
    }

    public function __construct(IAuthorize $authorizeRepository)
    {
        return $this->authorizeRepo = $authorizeRepository;
    }

    public function roles()
    {
        return $this->authorizeRepo->roles();
    }

    public function permissions()
    {
        return $this->authorizeRepo->permissions();
    }

    public function createRole(Request $request)
    {
        return $this->authorizeRepo->createRole($request);
    }

    public function createPermission(Request $request)
    {
        return $this->authorizeRepo->createPermission($request);
    }

    public function assignRoleToPermission(Request $request)
    {
        return $this->authorizeRepo->assignRoleToPermission($request);
    }

    public function rolePermissions($role_id)
    {
        return $this->authorizeRepo->rolePermissions($role_id);
    }

    public function assignRoleToUser(Request $request)
    {
        return $this->authorizeRepo->assignRoleToUser($request);
    }

    public function userPermissions($user_id)
    {
        return $this->authorizeRepo->userPermissions($user_id);
    }

    public function revoke(Request $request)
    {
        return $this->authorizeRepo->revoke($request);
    }
}
