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

        dd($detail->created_at, $detail->getKey(), $detail->author->toArray());
    }

    public function list(Request $request)
    {
        $lists = Book::name()->paginate();

        dd($lists);
    }


    public function chunks(Request $request)
    {
        set_time_limit(0);

        $start = memory_get_usage();

        $query = Book::query();

        $query->where('id', '<=', 150000);

        $query->chunk(10000, function ($results, $page) {
            foreach ($results as $result) {
//                echo $result->id . PHP_EOL;
                echo print_r($result->toArray());
            }
        });

        $end = memory_get_usage();

        echo memory_get_peak_usage(true) . PHP_EOL;

        echo (int)(($end - $start) / 1024 / 1024);

        //echo $end - $start;
    }

    public function cursor()
    {
        set_time_limit(0);

        $start = memory_get_usage();

        foreach (Book::where('id', '<=', 150000)->cursor() as $book) {
            //echo $book->id . PHP_EOL;
            echo print_r($book->toArray());
        }

        $end = memory_get_usage();

        echo memory_get_peak_usage(true) . PHP_EOL;

        echo (int)(($end - $start) / 1024 / 1024);

        //echo $end - $start;
    }

    public function non_cursor()
    {
        set_time_limit(0);

        $start = memory_get_usage();

        $books = Book::where('id', '<=', 150000)->get();

        foreach ($books as $book) {
            echo $book->id . PHP_EOL;
        }

        $end = memory_get_usage();

        echo memory_get_peak_usage(true) . PHP_EOL;

        echo (int)(($end - $start) / 1024 / 1024);

        //echo $end - $start;
    }

    public function create(Request $request)
    {
        Book::create($request->all());

        //Book::create($request->all());
    }

    public function fill(Request $request)
    {
        $book = Book::query()->find($request->get('id'));

        $book->fill($request->all());

        $book->save();

        echo $book;
    }

    public function save()
    {

    }
}