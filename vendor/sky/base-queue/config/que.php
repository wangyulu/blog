<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-08
 * Time: 15:39
 */

return [
    // 业务Code
    // 1.xx 2.xxx
    'business_id'  => env('QUEUE_BUSINESS_ID', 1),

    // 环境配置 1.生产 2.灰度 3.测试 4.开发
    'environment'  => env('QUEUE_ENVIRONMENT', 1),

    // 历史统计
    'stat_history' => [
        env('QUEUE_STAT_HISTORY_5', 5)   => explode(',', env('QUEUE_STAT_HISTORY_5_STATUS', '0,1,2,3,4')),
        env('QUEUE_STAT_HISTORY_10', 10) => explode(',', env('QUEUE_STAT_HISTORY_10_STATUS', '0,1,2,3,4')),
    ],
];