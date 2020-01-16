<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-14
 * Time: 14:16
 */

namespace App\Http\Bll\OrderState;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Bll\OrderState\States\PayState;
use App\Http\Bll\OrderState\States\SendState;
use App\Http\Bll\OrderState\States\CancelState;
use App\Http\Bll\OrderState\States\WaitPayState;
use App\Http\Bll\OrderState\States\DefaultState;
use App\Http\Bll\OrderState\States\WaitSendState;

class Context
{
    protected
        $defState,
        $waitPayState,
        $payState,
        $waitSendState,
        $sendState,
        $cancelState;

    /**
     * @var \App\Http\Bll\OrderState\State
     */
    protected $currentState;

    /**
     * @var Order
     */
    protected $order;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var User
     */
    protected $user;

    public function __construct(Order $order, User $user, Request $request)
    {
        $this->request = $request;

        $this->user = $user;

        $this->defState      = new DefaultState($this);
        $this->waitPayState  = new WaitPayState($this);
        $this->payState      = new PayState($this);
        $this->waitSendState = new WaitSendState($this);
        $this->sendState     = new SendState($this);
        $this->cancelState   = new CancelState($this);

        $this->setState($this->getStateByOrder($order), $order);
    }

    /**
     * @return Context
     */
    public static function makeWith(Order $order, User $user, Request $request)
    {
        return new self($order, $user, $request);
    }

    public function setState(State $state, Order $order)
    {
        $this->currentState = $state;

        $this->setOrder($order);

        return $this;
    }

    public function getStateByOrder(Order $order)
    {
        $stateArr = [
            Order::DEFAULT_STATUS   => $this->getDefaultState(),
            Order::WAIT_PAY_STATUS  => $this->getWaitPayState(),
            Order::PAY_STATUS       => $this->getPayState(),
            Order::WAIT_SEND_STATUS => $this->getWaitSendState(),
            Order::SEND_STATUS      => $this->getSendState(),
            Order::CANCEL_STATUS    => $this->getCancelState()
        ];

        if (!in_array($order->status, array_keys($stateArr))) {
            throw new \Exception(sprintf('order_status_not_found order: %s', $order));
        }

        return array_get($stateArr, $order->status);
    }

    public function setOrder(Order $order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    public function postDefault()
    {
        $this->currentState->postDefault();

        return $this;
    }

    public function postWaitPay()
    {
        $this->currentState->postWaitPay();

        return $this;
    }

    public function postPay()
    {
        $this->currentState->postPay();

        return $this;
    }

    public function postWaitSend()
    {
        $this->currentState->postWaitSend();

        return $this;
    }

    public function postSend()
    {
        $this->currentState->postSend();

        return $this;
    }

    public function postCancel()
    {
        $this->currentState->postCancel();

        return $this;
    }

    public function getDefaultState()
    {
        return $this->defState;
    }

    public function getWaitPayState()
    {
        return $this->waitPayState;
    }

    public function getPayState()
    {
        return $this->payState;
    }

    public function getWaitSendState()
    {
        return $this->waitSendState;
    }

    public function getSendState()
    {
        return $this->sendState;
    }

    public function getCancelState()
    {
        return $this->cancelState;
    }
}