<?php

namespace App\Http\Controllers;

use App\Article;
use App\Favorite;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

    }

    public function store(Article $article, $id)

    {

        $article = Article::find($id);
        $article->favorite();

        return back();

    }

    public function delete($id)

    {

        $favorite = Article::find($id);
        $attributes = ['user_id' => auth()->id()];


        if ($favorite->favorites()->where($attributes)) {
            $favorite->favorites()->where($attributes)->delete();
        }

        return back();

    }

}
