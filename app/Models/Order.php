<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-17
 * Time: 10:23
 */

namespace App\Models;

class Order extends BaseModel
{
    protected $table = 'design_fsm_order';

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

    const DEFAULT_STATUS_ALIAS   = 'def';
    const WAIT_PAY_STATUS_ALIAS  = 'wait_pay';
    const PAY_STATUS_ALIAS       = 'pay';
    const WAIT_SEND_STATUS_ALIAS = 'wait_send';
    const SEND_STATUS_ALIAS      = 'send';
    const CANCEL_STATUS_ALIAS    = 'cancel';

    const STATUS_MAPPING_ALIAS = [
        self::DEFAULT_STATUS   => self::DEFAULT_STATUS_ALIAS,
        self::WAIT_PAY_STATUS  => self::WAIT_PAY_STATUS_ALIAS,
        self::PAY_STATUS       => self::PAY_STATUS_ALIAS,
        self::WAIT_SEND_STATUS => self::WAIT_SEND_STATUS_ALIAS,
        self::SEND_STATUS      => self::SEND_STATUS_ALIAS,
        self::CANCEL_STATUS    => self::CANCEL_STATUS_ALIAS,
    ];

    const FINAL_STATUS = [
        self::CANCEL_STATUS_ALIAS,
    ];

    const CAN_CANCEL_STATUS = [
        self::WAIT_PAY_STATUS_ALIAS,
        self::PAY_STATUS_ALIAS,
        self::WAIT_SEND_STATUS_ALIAS,
        self::SEND_STATUS_ALIAS,
    ];

    const INITIAL_STATUS = self::DEFAULT_STATUS_ALIAS;
}