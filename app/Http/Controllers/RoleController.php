<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-09-28
 * Time: 19:06
 */

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function userDetail(Request $request, $id)
    {
        $role = Role::find($id);

        dd($role->users->toArray());
    }

    public function userDetailWithPivot(Request $request, $id)
    {
        $roles = Role::find($id);

        foreach ($roles->usersWithPivot as $user) {
            dd($user->role_bd, $user);
        }
    }

    public function detailWithThroughIphone(Request $request, $id)
    {

    }
}