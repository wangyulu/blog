<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-08
 * Time: 15:18
 */

namespace Sky\BaseQueue\Http\Controllers\V1_0\Test;

use Sky\BaseQueue\Jobs\TestSendSms;
use App\Http\Controllers\Controller;

class QueueController extends Controller
{
    public function storeUser()
    {
        dispatch(new TestSendSms([random_int(1, 9999)]));
//        $this->dispatch(new SendSms([random_int(1, 9999)]));
        echo 'done';
    }
}