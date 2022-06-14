<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function getAllArticle()
    {
        return Article::all();
    }
    public function getArticle(Article $article)
    {
        // normal way to find article

        //return Article::findorFail($id);

        // implecit model binding way to find article
        return $article;
    }

    public function createArticales(Request $request)
    {
        $title = $request->title;
        $content = $request->content;
        $user = $request->user();

        $article = new Article();

        $article->title = $title;
        $article->content = $content;
        $article->user_id = $user->id;

        $article->save();
        return $article;
    }
}
