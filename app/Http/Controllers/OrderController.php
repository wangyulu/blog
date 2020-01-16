<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-14
 * Time: 14:09
 */

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Http\Bll\OrderBll;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * @return User
     */
    public function getUser()
    {
        $user = User::find(app('request')->get('user_id'));

        if (!$user) {
            throw new \Exception('user not found');
        }

        return $user;
    }

    public function create(Request $request)
    {
        OrderBll::create($this->getUser(), $request);
    }

    public function pay(Request $request)
    {
        OrderBll::pay($this->getUser(), $request);
    }

    public function send(Request $request)
    {
        OrderBll::send($this->getUser(), $request);
    }

    public function cancel(Request $request)
    {
        OrderBll::cancel($this->getUser(), $request);
    }

    public function lists()
    {
        $paginators = Order::query()->paginate();

        foreach ($paginators as $model) {
            print_r($model->toArray());
        }
        //dd(Order::query()->paginate()->items());
    }
}