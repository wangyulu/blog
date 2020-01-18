<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-17
 * Time: 16:15
 */

namespace App\Http\Bll\Order\Core;

use App\Models\Order;
use App\Support\StateMachine\Contracts\StatefulInterface;

class OrderStateful implements StatefulInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Order
     */
    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;

        $this->initState();
    }

    public function initState(): void
    {
        $this->name = array_get(Order::STATUS_MAPPING_ALIAS, $this->order->status, Order::DEFAULT_STATUS_ALIAS);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}