<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-17
 * Time: 10:30
 */

namespace App\Http\Bll;


use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Bll\Order\OrderStatusHandler;

class OrderBll
{
    public static function create(User $user, Request $request)
    {
        $order              = new Order();
        $order->user_id     = $user->id;
        $order->user_name   = $user->name;
        $order->user_mobile = $user->mobile;
        $order->status      = Order::DEFAULT_STATUS;
        $order->save();

        OrderStatusHandler::make($order)->apply('jump_to_wait_pay');

        dd($order->toArray());
    }

    public static function pay(User $user, Request $request)
    {
        $order = OrderStatusHandler::makeById($request->get('order_id'))->apply('pay_by_user');

        dd($order->toArray());
    }

    public static function send(User $user, Request $request)
    {
        $order = OrderStatusHandler::makeById($request->get('order_id'))->apply('send');

        dd($order->toArray());
    }

    public static function cancel(User $user, Request $request)
    {
        $order = OrderStatusHandler::makeById($request->get('order_id'))->apply('cancel_by_user');

        dd($order->toArray());
    }
}