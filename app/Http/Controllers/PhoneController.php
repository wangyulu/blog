<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-09-28
 * Time: 14:49
 */

namespace App\Http\Controllers;

use App\Phone;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function detail(Request $request, $id)
    {
        $phone = Phone::find($id);

        dd($phone->user->toArray());
    }
}