<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-17
 * Time: 14:31
 */

namespace App\Support\StateMachine\Contracts;

interface StatefulInterface
{
    public function getName(): string;

    public function setName(string $name): void;
}