<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-11-23
 * Time: 16:45
 */

namespace App\Http\Controllers;

use App\BookCategory;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
    public function detail(Request $request, $id)
    {
        $category = BookCategory::find($id);

        dd($category->authors->toArray());
    }
}