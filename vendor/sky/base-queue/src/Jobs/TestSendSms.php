<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-08
 * Time: 15:23
 */

namespace Sky\BaseQueue\Jobs;

use Log;
use App\Jobs\Job;

class TestSendSms extends Job
{
    protected $params = [];

    public function __construct($params = [])
    {
        $this->params = $params;
        $this->onQueue('sms_send');
    }

    public function handle()
    {
        Log::info('【run】', [json_encode($this->params)]);
    }

    public function displayName()
    {
        return '【短信发送】创建完用户12';
    }
}