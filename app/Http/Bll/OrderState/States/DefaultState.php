<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-14
 * Time: 14:18
 */

namespace App\Http\Bll\OrderState\States;

use App\Models\Order;
use Illuminate\Support\Str;
use App\Http\Bll\OrderState\State;
use App\Http\Bll\OrderState\Context;

class DefaultState implements State
{
    /**
     * @var Context
     */
    protected $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    public function postDefault()
    {
        // TODO: Implement postDefault() method.
        $order = $this->context->getOrder();

        $order->user_id     = $this->context->getUser()->id;
        $order->user_name   = $this->context->getUser()->name;
        $order->user_mobile = $this->context->getUser()->mobile;
        $order->order_sn    = Str::random(32);

        $order->save();

        $this->context->setState($this->context->getDefaultState(), $order);

        $this->context->postWaitPay();
    }

    public function postWaitPay()
    {
        // TODO: Implement postWaitPay() method.
        $order = $this->context->getOrder();

        $order->status = Order::WAIT_PAY_STATUS;

        $order->save();
    }

    public function postPay()
    {
        // TODO: Implement postPay() method.
        throw new \Exception('err def -> pay');
    }

    public function postWaitSend()
    {
        // TODO: Implement postWaitSend() method.
        throw new \Exception('err def -> wait_send');
    }

    public function postSend()
    {
        // TODO: Implement postSend() method.
        throw new \Exception('err def -> send');
    }

    public function postCancel()
    {
        // TODO: Implement postCancel() method.
        throw new \Exception('err def -> cancel');
    }
}