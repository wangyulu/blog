<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-17
 * Time: 16:30
 */

namespace App\Http\Bll\Order\Core;

use App\Models\Order;
use App\Support\StateMachine\State;
use App\Support\StateMachine\Blueprint;

class OrderBlueprint extends Blueprint
{
    public function configure(): void
    {
        $this->addState(Order::INITIAL_STATUS, State::TYPE_INITIAL);

        foreach (Order::STATUS_MAPPING_ALIAS as $state) {
            if (in_array($state, Order::FINAL_STATUS)) {
                $this->addState($state, State::TYPE_FINAL);
            } else {
                $this->addState($state, State::TYPE_NORMAL);
            }
        }

        // todo 是否可以入到配置文件
        // 自动跳转 --------------------------------

        // 1.默认状态跳转到待支付
        $this->addTransition('jump_to_wait_pay', Order::DEFAULT_STATUS_ALIAS, Order::WAIT_PAY_STATUS_ALIAS);

        // 用户触发 --------------------------------
        $this->addTransition('cancel_by_user', Order::CAN_CANCEL_STATUS, Order::CANCEL_STATUS_ALIAS);
        $this->addTransition('pay_by_user', Order::WAIT_PAY_STATUS_ALIAS, Order::WAIT_SEND_STATUS_ALIAS);
        $this->addTransition('send', Order::WAIT_SEND_STATUS_ALIAS, Order::SEND_STATUS_ALIAS);
    }

    public function postJumpToWaitPay(OrderStateful $stateful, array $parameters = [])
    {
        $stateful->order->status = Order::WAIT_PAY_STATUS;
        $stateful->order->save();
    }

    public function postCancelByUser(OrderStateful $stateful, array $parameters = [])
    {
        $stateful->order->status = Order::CANCEL_STATUS;
        $stateful->order->save();
    }

    public function postPayByUser(OrderStateful $stateful, array $parameters = [])
    {
        $stateful->order->status = Order::WAIT_SEND_STATUS;
        $stateful->order->save();
    }

    public function postSend(OrderStateful $stateful, array $parameters = [])
    {
        $stateful->order->status  = Order::SEND_STATUS;
        $stateful->order->address = array_get($parameters, 'address', '');
        $stateful->order->company = array_get($parameters, 'company', '');
        $stateful->order->save();
    }
}