<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-17
 * Time: 17:03
 */

namespace App\Http\Bll\Order;

use App\Models\Order;
use App\Support\StateMachine\Machine;
use App\Http\Bll\Order\Core\OrderStateful;
use App\Http\Bll\Order\Core\OrderBlueprint;
use App\Support\StateMachine\Exceptions\LogicException;
use App\Support\StateMachine\Exceptions\SetStateFailedException;
use App\Support\StateMachine\Exceptions\TransitionNotFoundException;

class OrderStatusHandler
{
    /**
     * @var Order
     */
    protected $order;

    /**
     * @var Machine
     */
    protected $machine;

    /**
     * @var OrderBlueprint
     */
    protected $blueprint;

    /**
     * @var OrderStateful
     */
    protected $stateful;

    public function __construct(Order $order)
    {
        $this->order = $order;

        $this->initMachine();
    }

    protected function initMachine()
    {
        $this->stateful = new OrderStateful($this->order);

        $this->blueprint = new OrderBlueprint();

        $this->machine = new Machine($this->stateful, $this->blueprint);
    }

    /**
     * @param Order $order
     *
     * @return OrderStatusHandler
     */
    public static function make(Order $order): self
    {
        return new self($order);
    }

    /**
     * @param int $id
     *
     * @return OrderStatusHandler
     * @throws \Exception
     */
    public static function makeById(int $id): self
    {
        if (!$order = Order::find($id)) {
            throw new \Exception(sprintf('order not found ID: %s', $id));
        }

        return new self($order);
    }

    /**
     * @param string $transitionName
     * @param array  $parameters
     *
     * @return Order
     * @throws \Exception
     */
    public function apply(string $transitionName, array $parameters = []): Order
    {
        try {
            // todo 需要针对订单的状态变更加锁

            $this->machine->apply($transitionName, $parameters);
        } catch (TransitionNotFoundException $e) {
            throw new \Exception('order status not found');
        } catch (LogicException $e) {
            throw new \Exception('order not can transition');
        } catch (SetStateFailedException $e) {
            throw new \Exception('order status set err');
        }

        return $this->order;
    }
}