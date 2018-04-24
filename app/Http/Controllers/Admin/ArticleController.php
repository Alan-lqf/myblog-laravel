<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Article;

class ArticleController extends Controller
{
    public function index() {
        return view('admin/article/index')->withArticles(Article::all());
    }


    public function create() {
        return view('admin/article/create');
    }


    public function store(Request $request) {
        //数据验证
        $this->validate($request, [
            'title' => 'required|unique:articles|max:255',
            'body' => 'required',
        ]);

        //通过Article Model 插入一条数据进article表
        $article = new Article;
        $article->title = $request->get('title');
        $article->body = $request->get('body');
        $article->user_id = $request->user()->id;

        if($article->save()) {
            return redirect('admin/articles');
        } else {
            //保存失败，跳回来路页面，保留用户的输入，并给出提示
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    public function destroy($id) {
        Article::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }
}
