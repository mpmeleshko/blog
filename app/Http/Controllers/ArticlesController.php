<?php

namespace App\Http\Controllers;


use App\Article;

use App\Favorite;
use App\Http\Requests\ArticlesRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArticlesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        $articles = Article::latest()
            ->filter(request()->only(['month', 'year']))
            ->get();

        return view('articles.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        $article->check_article($article);

        return view('articles.show', compact('article'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(ArticlesRequest $request)
    {
        $article = Article::create([
            'user_id' => auth()->user()->id,
            'title' => request('title'),
            'body' => request('body')
        ]);

        //загрузка и сохванение изображения
        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $filename = $file->getClientOriginalName();
            $file->move('images', $filename);//папка для загрузки изображения
            if ($filename) {
                $artic = Article::find($article->id);
                $artic->image = '/images/' . $filename;
                $artic->save();
            }
        }

        return redirect()->home();
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);

        //поиск юзера, который первый лайкнул
        $favorite = $article->favorites()
            ->oldest()->where(['favorited_id' => $id])
            ->first();
        if ($favorite != null) {
            $favoriteUser = $favorite->user_id;
            if (auth()->id() == $favoriteUser) {
                return view('articles.edit', compact('article'));
            }
        }

        return back()->with('message', 'You can\'t edit this article');
    }

    public function update(ArticlesRequest $request, $id)
    {
        $article = Article::find($id);
        $article->title = request('title');
        $article->body = request('body');
        $article->save();

        return redirect()->route('article_id', ['id' => $id]);
    }

    public function delete($id)
    {
        $article = Article::find($id);
        if ($article->user_id == auth()->id()) {
            $article->delete();
        } else {
            back();
        }

        return redirect()->home();
    }
}
