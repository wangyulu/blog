<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-09-14
 * Time: 19:14
 */

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function detail(Request $request, $id)
    {
        $detail = Book::find($id);

        dd($detail->author);
    }

    public function list(Request $request)
    {
        $lists = Book::name()->paginate()->toArray();

        dd($lists);
    }
}