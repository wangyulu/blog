<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-09
 * Time: 11:27
 */

namespace Sky\BaseQueue\Models;

use Illuminate\Database\Eloquent\Model;

class QueueModel extends Model
{
    protected $connection = 'common_db';

    protected $table = 'queue';

    protected $fillable = [
        'class_name',
        'name',
        'business',
        'description',
        'last_status',
    ];

    // 执行状态 0.待处理 1.处理中 2.成功 3.失败 4.异常
    const STATUS_WAIT  = 0;
    const STATUS_RUN   = 1;
    const STATUS_SUCC  = 2;
    const STATUS_FAIL  = 3;
    const STATUS_EXCEP = 4;

    const STATUS_WAIT_CODE  = 'wait';
    const STATUS_RUN_CODE   = 'run';
    const STATUS_SUCC_CODE  = 'succ';
    const STATUS_FAIL_CODE  = 'fail';
    const STATUS_EXCEP_CODE = 'excep';

    public static function getStatusCode()
    {
        return [
            self::STATUS_WAIT  => self::STATUS_WAIT_CODE,
            self::STATUS_RUN   => self::STATUS_RUN_CODE,
            self::STATUS_SUCC  => self::STATUS_SUCC_CODE,
            self::STATUS_FAIL  => self::STATUS_FAIL_CODE,
            self::STATUS_EXCEP => self::STATUS_EXCEP_CODE,
        ];
    }
}