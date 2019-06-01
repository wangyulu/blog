<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-13
 * Time: 16:07
 */

namespace Sky\BaseQueue\Http\Controllers\V1_0;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function getPage(Request $request)
    {
        return $request->get('page', 1);
    }

    public function getPageSize(Request $request)
    {
        return $request->get('pageSize', 20);
    }
}