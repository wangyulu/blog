<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-09-28
 * Time: 17:34
 */

namespace App\Http\Controllers;

use App\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function detail(Request $request, $id)
    {
        $post = Posts::find($id);

        dd($post->comments->toArray());
    }

    public function detailMorphToImage(Request $request, $id)
    {
        $post = Posts::find($id);

        dd($post->image);
    }

    public function detailMorphToImages(Request $request, $id)
    {
        $post = Posts::find($id);

        dd($post->images->toArray());
    }

    public function detailMorphToTags(Request $request, $id)
    {
        $post = Posts::find($id);

        dd($post->tags->toArray());
    }
}