<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function article1()
    {
        return view('article1');
    }

    public function article2()
    {
        return view('article2');
    }

    public function article3()
    {
        return view('article3');
    }
}
