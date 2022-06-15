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

    function updateArticle(Request $request, Article $article)
    {
        $user = $request->user();

        if ($user->id != $article->user_id) {
            return response()->json(["Error" => "You dont't have permission to edit this article"], 404);
        } else {

            $title = $request->title;
            $content = $request->content;

            $article->title = $title;
            $article->content = $content;
            $article->save();

            return $article;
        }
    }
    function deleteArticle(Request $request, Article $article)
    {
        $user = $request->user();

        if ($user->id != $article->user_id) {
            return response()->json(["Error" => "You dont't have permission to delete this article"], 404);
        } else {

            $article->delete();
            return response()->json(["Success" => "Article deleletion completed"], 200);
        }
    }
}
