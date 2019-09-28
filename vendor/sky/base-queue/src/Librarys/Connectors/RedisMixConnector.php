<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-09-28
 * Time: 10:54
 */

namespace Sky\BaseQueue\Librarys\Connectors;

use Sky\BaseQueue\Librarys\RedisMixQueue;
use Illuminate\Contracts\Redis\Factory as Redis;
use Illuminate\Queue\Connectors\ConnectorInterface;

class RedisMixConnector implements ConnectorInterface
{
    /**
     * The Redis database instance.
     *
     * @var \Illuminate\Contracts\Redis\Factory
     */
    protected $redis;
    /**
     * The connection name.
     *
     * @var string
     */
    protected $connection;

    /**
     * Create a new Redis queue connector instance.
     *
     * @param  \Illuminate\Contracts\Redis\Factory $redis
     * @param  string|null                         $connection
     *
     * @return void
     */
    public function __construct(Redis $redis, $connection = null)
    {
        $this->redis      = $redis;
        $this->connection = $connection;
    }

    /**
     * Establish a queue connection.
     *
     * @param  array $config
     *
     * @return \Illuminate\Contracts\Queue\Queue
     */
    public function connect(array $config)
    {
        return new RedisMixQueue(
            $this->redis, $config['queue'],
            $config['connection'] ?? $this->connection,
            $config['retry_after'] ?? 60,
            $config['block_for'] ?? null
        );
    }
}