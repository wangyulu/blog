<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-17
 * Time: 14:35
 */

namespace App\Support\StateMachine;

use App\Support\StateMachine\Contracts\StatefulInterface;

class Transition
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var State[]
     */
    protected $fromStates;

    /**
     * @var State
     */
    protected $toState;

    public function __construct(string $name, $from, State $to)
    {
        $this->name = $name;

        $this->fromStates = (array)$from;

        $this->toState = $to;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return State[]
     */
    public function getFromStates(): array
    {
        return $this->fromStates;
    }

    /**
     * @return State
     */
    public function getToState(): State
    {
        return $this->toState;
    }

    /**
     * @param StatefulInterface $stateful
     * @param array             $parameters
     *
     * @return bool
     */
    public function can(StatefulInterface $stateful, array $parameters = []): bool
    {
        foreach ($this->fromStates as $state) {
            if ($state->getName() === $stateful->getName()) {
                // todo checker
                return true;
            }
        }

        return false;
    }
}