<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-13
 * Time: 17:03
 */

namespace Sky\BaseQueue\Models;

use Illuminate\Database\Eloquent\Model;

class QueueStatusChangeLogModel extends Model
{
    protected $connection = 'common_db';

    protected $table = 'queue_status_change_log';

    protected $fillable = [
        'queue_id',
        'from_status',
        'to_status',
    ];
}