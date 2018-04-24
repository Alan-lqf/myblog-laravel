<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/
//    用于登录

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home')->withArticles(Article::all());
    /*1. \App\Article::all() 是采用绝对命名空间方式对 Article 类的调用。
       2. withArticles 是我定义的方法，Laravel 并不提供，这也是 Laravel 优雅的一个表现：Laravel View 采用 __call 来 handle 对未定义 function 的调用，其作用很简单：给视图系统注入一个名为 $articles 的变量，这段代码等价于 ->with('articles', \App\Article::all())。
        3. 展开讲一下，->withFooBar(100) 等价于 ->with('foo_bar', 100)，即驼峰变量会被完全转换为蛇形变量。*/
    }
}
