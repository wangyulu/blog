<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-09-28
 * Time: 10:55
 */

namespace Sky\BaseQueue\Librarys;

use Illuminate\Queue\RedisQueue;

class RedisMixQueue extends RedisQueue
{
    /**
     * Create a payload string from the given job and data.
     *
     * @param  string $job
     * @param  mixed  $data
     *
     * @return string
     */
    protected function createPayloadArray($job, $data = '')
    {
        $ext = isset($_SERVER['HTTP_X_TRACE_ID'])
            ? blank($_SERVER['HTTP_X_TRACE_ID']) ? [] : ['HTTP_X_TRACE_ID' => $_SERVER['HTTP_X_TRACE_ID']]
            : [];
        return empty($ext)
            ? parent::createPayloadArray($job, $data)
            : array_merge(parent::createPayloadArray($job, $data), $ext);
    }
}