<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-14
 * Time: 13:56
 */

namespace App\Models;

class Order extends BaseModel
{
    protected $table = 'design_order';

    protected $fillable = [
        'user_id',
        'user_name',
        'user_mobile',
        'order_sn',
        'company',
        'address',
        'pay_at',
        'send_at',
        'cancel_at',
        'status',
    ];

    protected $dates = [
        'pay_at',
        'send_at',
        'cancel_at',
    ];

    const DEFAULT_STATUS   = 0;
    const WAIT_PAY_STATUS  = 10;
    const PAY_STATUS       = 20;
    const WAIT_SEND_STATUS = 30;
    const SEND_STATUS      = 40;
    const CANCEL_STATUS    = 50;

    public static function makeDefaultModel()
    {
        $order         = new static();
        $order->status = self::DEFAULT_STATUS;

        return $order;
    }
}