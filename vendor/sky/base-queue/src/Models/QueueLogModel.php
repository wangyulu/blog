<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-10
 * Time: 10:22
 */

namespace Sky\BaseQueue\Models;

use Illuminate\Database\Eloquent\Model;

class QueueLogModel extends Model
{
    protected $connection = 'common_db';

    protected $table = 'queue_log';

    protected $fillable = [
        'queue_id',
        'queue_uuid',
        'execution_time',
        'status',
        'err'
    ];
}