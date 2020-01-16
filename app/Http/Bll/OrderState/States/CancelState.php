<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-14
 * Time: 14:45
 */

namespace App\Http\Bll\OrderState\States;

use App\Http\Bll\OrderState\State;
use App\Http\Bll\OrderState\Context;

class CancelState implements State
{
    protected $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    public function postDefault()
    {
        // TODO: Implement postDefault() method.
        throw new \Exception('err cancel -> def');
    }

    public function postWaitPay()
    {
        // TODO: Implement postWaitPay() method.
        throw new \Exception('err cancel -> wait_pay');
    }

    public function postPay()
    {
        // TODO: Implement postPay() method.
        throw new \Exception('err cancel -> pay');
    }

    public function postWaitSend()
    {
        // TODO: Implement postWaitSend() method.
        throw new \Exception('err cancel -> wait_send');
    }

    public function postSend()
    {
        // TODO: Implement postSend() method.
        throw new \Exception('err cancel -> send');
    }

    public function postCancel()
    {
        // TODO: Implement postCancel() method.
        throw new \Exception('err already cancel');
    }
}