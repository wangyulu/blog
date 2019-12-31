<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-09-02
 * Time: 20:13
 */

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function detail(Request $request, $id)
    {
        $users = User::name('ccc', 1)->find($id);

        dd($users->attributesToArray(), $users);

        $res = optional($users->get(0))->update(['created_at' => date('Y-m-d H:i:s')]);

        response($res)->send();
    }

    public function save(Request $request)
    {
        $params = $this->validate($request, [
                'name'   => 'required|string',
                'email'  => 'required|string',
                'ticket' => 'string',
                'id'     => 'integer'
            ]
        );

        $user = User::findOrNew(array_get($params, 'id', 0));

        $user->fill($params)->save();

        dd($user);
    }

    public function roleDetail(Request $request, $id)
    {
        $user = User::find($id);

        dd($user->roles->toArray());

        foreach ($user->roles as $role) {
            print_r($role->pivot);
            exit;
        }
    }

    public function detailPosts(Request $request, $id)
    {
        $user = User::find($id);

        dd($user->posts->toArray());
    }

    public function detailHasPosts(Request $request, $id)
    {
//        $user = User::find($id);

        $s = User::has('posts')->get();

        dd($s->toArray());
    }

    public function detailWithPhone(Request $request, $id)
    {
        $s = User::find($id);

        dd($s->phone->toArray());
    }
}