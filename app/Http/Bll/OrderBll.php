<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-14
 * Time: 14:14
 */

namespace App\Http\Bll;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Bll\OrderState\Context;

class OrderBll
{
    public static function create(User $user, Request $request)
    {
        $context = Context::makeWith(Order::makeDefaultModel(), $user, $request);

        dd($context->postDefault()->getOrder()->toArray());
    }

    public static function pay(User $user, Request $request)
    {
        $order = Order::find($request->get('order_id'));

        $context = Context::makeWith($order, $user, $request);

        dd($context->postPay()->getOrder()->toArray());
    }

    public static function send(User $user, Request $request)
    {
        $order = Order::find($request->get('order_id'));

        $context = Context::makeWith($order, $user, $request);

        dd($context->postSend()->getOrder()->toArray());
    }

    public static function cancel(User $user, Request $request)
    {
        $order = Order::find($request->get('order_id'));

        $context = Context::makeWith($order, $user, $request);

        dd($context->postCancel()->getOrder()->toArray());
    }
}