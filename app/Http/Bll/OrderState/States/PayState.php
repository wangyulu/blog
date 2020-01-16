<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-14
 * Time: 14:29
 */

namespace App\Http\Bll\OrderState\States;

use Carbon\Carbon;
use App\Models\Order;
use App\Http\Bll\OrderState\State;
use App\Http\Bll\OrderState\Context;

class PayState implements State
{
    protected $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    public function postDefault()
    {
        // TODO: Implement postDefault() method.
        throw new \Exception('err pay -> def');
    }

    public function postWaitPay()
    {
        // TODO: Implement postWaitPay() method.
        throw new \Exception('err pay -> wait_pay');
    }

    public function postPay()
    {
        // TODO: Implement postPay() method.
        throw new \Exception('err already pay');
    }

    public function postWaitSend()
    {
        // TODO: Implement postWaitSend() method.
        $order = $this->context->getOrder();

        $order->status = Order::WAIT_SEND_STATUS;

        $order->save();

        $this->context->setState($this->context->getWaitSendState(), $order);
    }

    public function postSend()
    {
        // TODO: Implement postSend() method.
        throw new \Exception('err pay -> send');
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