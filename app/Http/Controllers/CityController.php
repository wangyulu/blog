<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-11-25
 * Time: 09:59
 */

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function detailWithThroughIphone(Request $request, $id)
    {
        $city = City::query()->find($id);

        dd($city->iphone->toArray());
    }
}