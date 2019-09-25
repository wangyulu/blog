<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-09-14
 * Time: 19:06
 */

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function detail(Request $request, $id)
    {
        $detail = Author::find($id);

        dd($detail->books()->withoutConst()->getResults()->toArray());
    }
}