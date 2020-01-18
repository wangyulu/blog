<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-17
 * Time: 14:34
 */

namespace App\Support\StateMachine;

use App\Support\StateMachine\Events\Event;
use App\Support\StateMachine\Events\StateEventEnum;
use App\Support\StateMachine\Exceptions\LogicException;
use App\Support\StateMachine\Contracts\StatefulInterface;
use App\Support\StateMachine\Exceptions\SetStateFailedException;

class Machine
{
    /**
     * @var StatefulInterface
     */
    protected $stateful;

    /**
     * @var Blueprint
     */
    protected $blueprint;

    public function __construct(StatefulInterface $stateful, Blueprint $blueprint)
    {
        $this->stateful = $stateful;

        $this->blueprint = $blueprint;
    }

    /**
     * @return string
     */
    public function getCurrentState(): string
    {
        return $this->stateful->getName();
    }

    /**
     * @param string $transitionName
     * @param array  $parameters
     *
     * @return bool
     * @throws Exceptions\TransitionNotFoundException
     */
    public function can(string $transitionName, array $parameters = []): bool
    {
        return $this->blueprint
            ->getTransition($transitionName)
            ->can($this->stateful, $parameters);
    }

    /**
     * @param string $transitionName
     * @param array  $parameters
     *
     * @throws Exceptions\TransitionNotFoundException
     * @throws LogicException
     * @throws SetStateFailedException
     */
    public function apply(string $transitionName, array $parameters = []): void
    {
        if (!$this->can($transitionName, $parameters)) {
            throw new LogicException(
                sprintf('%s transition not apply %s, current state %s',
                    $transitionName,
                    $this->stateful->getName(),
                    get_class($this->stateful)
                )
            );
        }

        $transition = $this->blueprint->getTransition($transitionName);

        $state = $transition->getToState()->getName();

        $this->stateful->setName($state);

        if ($this->stateful->getName() != $state) {
            throw new SetStateFailedException(
                sprintf('set to status %s failed from %s',
                    $state,
                    $transition->getName()
                )
            );
        }

        $this->dispatchEvent(StateEventEnum::POST_TRANSITION . $transitionName, $parameters);
    }

    /**
     * @param string $event
     * @param array  $parameters
     */
    private function dispatchEvent(string $event, array $parameters = []): void
    {
        $this->blueprint->getDispatcher()->dispatch($event, new Event($this->stateful, $parameters));
    }
}