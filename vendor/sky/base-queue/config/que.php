<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-08
 * Time: 15:39
 */

return [
    // URL前缀
    'path'          => '',

    // 业务Code
    'business_code' => env('QUEUE_BUSINESS_CODE', 'kbdj'),

    // 历史统计
    'stat_history'  => [
        env('QUEUE_STAT_HISTORY_5', 5)   => explode(',', env('QUEUE_STAT_HISTORY_5_STATUS', '1,2,3')),
        env('QUEUE_STAT_HISTORY_10', 10) => explode(',', env('QUEUE_STAT_HISTORY_10_STATUS', '1,2,3')),
    ]
];