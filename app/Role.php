<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-09-14
 * Time: 19:09
 */

namespace App;

use App\Models\Pivots\UserRolePivot;

class Role extends BaseModel
{
    protected $table = 'role';

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role', 'r_id', 'u_id');
    }

    public function usersWithPivot()
    {
        return $this->belongsToMany(User::class, 'user_role', 'r_id', 'u_id')
            ->using(UserRolePivot::class)
            ->as('role_bd');
    }
}