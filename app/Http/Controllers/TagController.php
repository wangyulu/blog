<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-11-28
 * Time: 13:27
 */

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function detail(Request $request, $id)
    {
        $tag = Tag::find($id);

        dd($tag->post->toArray(), $tag->user->toArray());
    }
}