<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-14
 * Time: 14:28
 */

namespace App\Http\Bll\OrderState\States;

use Carbon\Carbon;
use App\Models\Order;
use App\Http\Bll\OrderState\State;
use App\Http\Bll\OrderState\Context;

class WaitPayState implements State
{
    protected $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    public function postDefault()
    {
        // TODO: Implement postDefault() method.
        throw new \Exception('err wait_pay -> def');
    }

    public function postWaitPay()
    {
        // TODO: Implement postWaitPay() method.
        throw new \Exception('err already wait_pay');
    }

    public function postPay()
    {
        // TODO: Implement postPay() method.
        $order = $this->context->getOrder();

        $order->status = Order::PAY_STATUS;
        $order->pay_at = Carbon::now();

        $order->save();

        $this->context->setState($this->context->getPayState(), $order);

        $this->context->postWaitSend();
    }

    public function postWaitSend()
    {
        // TODO: Implement postWaitSend() method.
        throw new \Exception('err wait_pay -> wait_send');
    }

    public function postSend()
    {
        // TODO: Implement postSend() method.
        throw new \Exception('err wait_pay -> send');
    }

    public function postCancel()
    {
        // TODO: Implement postCancel() method.
        $order = $this->context->getOrder();

        $order->status    = Order::CANCEL_STATUS;
        $order->cancel_at = Carbon::now();

        $order->save();

        $this->context->setState($this->context->getCancelState(), $order);
    }
}