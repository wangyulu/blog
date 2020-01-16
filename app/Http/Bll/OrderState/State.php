<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-14
 * Time: 14:18
 */

namespace App\Http\Bll\OrderState;

interface State
{
    public function postDefault();

    public function postWaitPay();

    public function postPay();

    public function postWaitSend();

    public function postSend();

    public function postCancel();
}