<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-18
 * Time: 11:34
 */

namespace App\Support\StateMachine\Events;

use Symfony\Component\EventDispatcher\Event as BaseEvent;
use App\Support\StateMachine\Contracts\StatefulInterface;

class Event extends BaseEvent
{
    /**
     * @var StatefulInterface
     */
    protected $stateful;

    /**
     * @var array
     */
    protected $parameters;

    public function __construct(StatefulInterface $stateful, array $parameters = [])
    {
        $this->stateful = $stateful;

        $this->parameters = $parameters;
    }

    /**
     * @return StatefulInterface
     */
    public function getStateful(): StatefulInterface
    {
        return $this->stateful;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
}