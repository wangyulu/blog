<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-09
 * Time: 10:51
 */

namespace Sky\BaseQueue\Bll;

use Illuminate\Http\Request;
use Sky\BaseQueue\Models\QueueModel;
use Sky\BaseQueue\Models\QueueLogModel;
use Sky\BaseQueue\Models\QueueStatusChangeLogModel;

class QueueBll extends BaseBll
{
    public static function lists(Request $request, $page, $pageSize)
    {
        $query = QueueModel::query();
        $res   = $query->skip(self::getSkip($page, $pageSize))
            ->take($pageSize)
            ->where('bid', config('que.business_id'))
            ->where('env', config('que.environment'))
            ->orderBy('id', 'desc')
            ->get();

        if (!$res || empty($ress = $res->toArray())) {
            return [];
        }

        foreach ($res as $item) {
            $item->statusChangeLog->toArray();
        }

        return $res->toArray();
    }

    public static function logLists(Request $request, $page, $pageSize)
    {
        $query = QueueLogModel::query();
        $res   = $query->skip(self::getSkip($page, $pageSize))
            ->take($pageSize)
            ->where('queue_id', $request->queue_id)
            ->orderBy('id', 'desc')
            ->get();

        if (!$res || empty($ress = $res->toArray())) {
            return [];
        }

        return $ress;
    }

    public static function stat(Request $request, $page, $pageSize)
    {
        $waitCount = $runCount = 0;

        $query = QueueModel::query();
        $res   = $query->skip(self::getSkip($page, $pageSize))
            ->take($pageSize)
            ->where('bid', config('que.business_id'))
            ->where('env', config('que.environment'))
            ->orderBy('id', 'desc')
            ->get();

        if (!$res || empty($ress = $res->toArray())) {
            return [$waitCount, $runCount];
        }

        foreach ($res as $item) {
            if ($item->statusChangeLog->to_status == QueueModel::STATUS_WAIT) {
                $waitCount++;
            }

            if ($item->statusChangeLog->to_status == QueueModel::STATUS_RUN) {
                $runCount++;
            }
        }

        return [$waitCount, $runCount];
    }

    public static function statHistory()
    {
        $config  = config('que.stat_history');
        $results = [];

        $query = QueueModel::query()
            ->where('bid', config('que.business_id'))
            ->where('env', config('que.environment'))
            ->get()
            ->pluck('id');

        if (empty($ids = $query->toArray())) {
            return $results;
        }

        foreach ($config as $hour => $status) {
            list($start, $end) = self::getOldDateTimeByHour($hour);
            $results[$hour] = self::mapStatusToDesc(self::_statHistory($start, $end, $status, $ids));
        }

        return $results;
    }

    private static function _statHistory($startTime, $endTime, $status, $ids)
    {
        $results = array_combine($status, array_fill(0, count($status), 0));

        $res = QueueStatusChangeLogModel::query()
            ->whereIn('to_status', $status)
            ->whereIn('queue_id', $ids)
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