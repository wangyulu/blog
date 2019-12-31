<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-09-28
 * Time: 17:35
 */

namespace App\Http\Controllers;

use App\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function detail(Request $request, $id)
    {
        $comment = Comments::find($id);

        dd($comment->post->toArray());
    }
}