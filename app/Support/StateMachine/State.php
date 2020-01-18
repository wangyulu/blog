<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-17
 * Time: 14:34
 */

namespace App\Support\StateMachine;

class State
{
    const TYPE_INITIAL = '1';
    const TYPE_NORMAL  = '2';
    const TYPE_FINAL   = '3';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    public function __construct(string $name, string $type)
    {
        $this->name = $name;

        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    public function isInitial()
    {
        return self::TYPE_INITIAL == $this->type;
    }

    public function isNormal()
    {
        return self::TYPE_NORMAL == $this->type;
    }

    public function isFinal()
    {
        return self::TYPE_FINAL == $this->type;
    }
}