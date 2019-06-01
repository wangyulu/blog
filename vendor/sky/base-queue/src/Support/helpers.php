<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-08
 * Time: 13:59
 */

function msectime()
{
    list($msec, $sec) = explode(' ', microtime());
    $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    return $msectime;
}

function setQueueStartTime()
{
    app('config')->set('que.start_time', msectime());
}

function getExecTime()
{
    return msectime() - app('config')->get('que.start_time', 0);
}