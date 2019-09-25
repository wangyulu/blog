<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-09-07
 * Time: 22:58
 */

namespace App\Models\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class EmailScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        // TODO: Implement apply() method.
        $request = app('request');
        if ($email = $request->get('email')) {
            $builder->where('email', $email);
        }
    }
}