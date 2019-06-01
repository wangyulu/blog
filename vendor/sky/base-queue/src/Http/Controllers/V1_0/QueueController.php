<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-13
 * Time: 15:23
 */

namespace Sky\BaseQueue\Http\Controllers\V1_0;

use Illuminate\Http\Request;
use Sky\BaseQueue\Bll\QueueBll;

class QueueController extends BaseController
{
    public function lists(Request $request)
    {
        echo json_encode(QueueBll::lists([], self::getPage($request), self::getPageSize($request)), true);
    }

    public function logs(Request $request)
    {
        echo json_encode(QueueBll::logLists([], self::getPage($request), self::getPageSize($request)), true);
    }

    public function stat(Request $request)
    {
        list($wait, $run) = QueueBll::stat();
        $data = [
            'wait' => $wait,
            'run'  => $run
        ];
        echo json_encode($data, true);
    }

    public function statHistory(Request $request)
    {
        echo json_encode(QueueBll::statHistory(), true);
    }
}