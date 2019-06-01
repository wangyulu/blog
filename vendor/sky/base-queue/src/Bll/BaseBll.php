<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-13
 * Time: 16:02
 */

namespace Sky\BaseQueue\Bll;

use Carbon\Carbon;

class BaseBll
{
    public static function getSkip($page, $pageSize)
    {
        return ($page - 1) * $pageSize;
    }

    public static function getOldDateTimeByHour($hour = 5)
    {
        $now = Carbon::now();

        $end = $now->toDateTimeString();

        return [
            $now->subRealHours($hour)->toDateTimeString(),
            $end
        ];
    }
}