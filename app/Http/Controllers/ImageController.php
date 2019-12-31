<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-11-25
 * Time: 15:04
 */

namespace App\Http\Controllers;

use App\Images;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function detailMorphTo(Request $request, $id)
    {
        $img = Images::find($id);

        dd($img->ables);
    }
}