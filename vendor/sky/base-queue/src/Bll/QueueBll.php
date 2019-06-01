<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-09
 * Time: 10:51
 */

namespace Sky\BaseQueue\Bll;

use Sky\BaseQueue\Models\QueueModel;
use Sky\BaseQueue\Models\QueueLogModel;
use Sky\BaseQueue\Models\QueueStatusChangeLogModel;

class QueueBll extends BaseBll
{
    public static function lists(array $cond, $page, $pageSize)
    {
        $query = QueueModel::query();
        $res   = $query->skip(self::getSkip($page, $pageSize))
            ->take($pageSize)
            ->orderBy('id', 'desc')
            ->get();

        if (!$res || empty($ress = $res->toArray())) {
            return [];
        }

        return $ress;
    }

    public static function logLists(array $cond, $page, $pageSize)
    {
        $query = QueueLogModel::query();
        $res   = $query->skip(self::getSkip($page, $pageSize))
            ->take($pageSize)
            ->orderBy('id', 'desc')
            ->get();

        if (!$res || empty($ress = $res->toArray())) {
            return [];
        }

        return $ress;
    }

    public static function stat()
    {
        return [
            QueueModel::query()->where('last_status', QueueModel::STATUS_WAIT)->count(),
            QueueModel::query()->where('last_status', QueueModel::STATUS_RUN)->count(),
        ];
    }

    public static function statHistory()
    {
        $config  = config('que.stat_history');
        $results = [];
        foreach ($config as $hour => $status) {
            list($start, $end) = self::getOldDateTimeByHour($hour);
            $results[$hour] = self::mapStatusToDesc(self::_statHistory($start, $end, $status));
        }

        return $results;
    }

    private static function _statHistory($startTime, $endTime, $status)
    {
        $results = array_combine($status, array_fill(0, count($status), 0));

        $res = QueueStatusChangeLogModel::query()
            ->whereIn('to_status', $status)
            ->where('created_at', '>=', $startTime)
            ->where('created_at', '<=', $endTime)
            ->get(['id', 'to_status']);
        if (!$res || empty($ress = $res->toArray())) {
            return $results;
        }

        foreach ($ress as $item) {
            $results[array_get($item, 'to_status')]++;
        }

        return $results;
    }

    private static function mapStatusToDesc($status)
    {
        $results   = [];
        $statusMap = QueueModel::getStatusCode();
        foreach ($statusMap as $state => $code) {
            if (isset($status[$state])) {
                $results[$code] = $status[$state];
            } else {
                $results[$code] = 0;
            }
        }

        return $results;
    }
}