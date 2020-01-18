<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-17
 * Time: 14:34
 */

namespace App\Support\StateMachine;

use App\Support\StateMachine\Tools\Str;
use App\Support\StateMachine\Events\Event;
use App\Support\StateMachine\Events\StateEventEnum;
use Symfony\Component\EventDispatcher\EventDispatcher;
use App\Support\StateMachine\Exceptions\StateNotFoundException;
use App\Support\StateMachine\Exceptions\TransitionNotFoundException;

abstract class Blueprint
{
    /**
     * @var State[]
     */
    protected $states;

    /**
     * @var Transition[]
     */
    protected $transitions;

    /**
     * @var EventDispatcher
     */
    protected $dispatcher;

    public function __construct()
    {
        $this->dispatcher = new EventDispatcher();

        $this->configure();
    }

    abstract public function configure(): void;

    /**
     * @return EventDispatcher
     */
    public function getDispatcher(): EventDispatcher
    {
        return $this->dispatcher;
    }

    protected function addState(string $name, string $type): self
    {
        $this->states[$name] = new State($name, $type);

        return $this;
    }

    public function getState(string $name): State
    {
        if (!array_key_exists($name, $this->states)) {
            throw new StateNotFoundException($name);
        }

        return $this->states[$name];
    }

    protected function addTransition(string $name, $from, string $to)
    {
        $froms = (array)$from;

        $fromStates = array_map(function ($state) {
            return $this->getState($state);
        }, $froms);

        $this->transitions[$name] = new Transition($name, $fromStates, $this->getState($to));

        $postMethod = 'post' . Str::studly($name);

        if (method_exists($this, $postMethod)) {
            $this->dispatcher->addListener(StateEventEnum::POST_TRANSITION . $name,
                $this->eventListener($postMethod)
            );
        }

        return $this;
    }

    /**
     * @param string $name
     *
     * @return Transition
     * @throws TransitionNotFoundException
     */
    public function getTransition(string $name): Transition
    {
        if (!array_key_exists($name, $this->transitions)) {
            throw new TransitionNotFoundException($name);
        }

        return $this->transitions[$name];
    }

    /**
     * @param string $method
     *
     * @return \Closure
     */
    private function eventListener(string $method): \Closure
    {
        return function (Event $event) use ($method) {
            return call_user_func([$this, $method], $event->getStateful(), $event->getParameters());
        };
    }
}