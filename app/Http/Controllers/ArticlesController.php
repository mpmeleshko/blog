<?php

namespace App\Http\Controllers;


use App\Article;

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

        return view('articles.show', compact('article'));
        
    }

    
    public function create()

    {
        
        return view('articles.create');
        
    }

    
    public function store()

    {

        $this->validate(request(), [

            'title' => 'required',

            'body' => 'required',


        ]);


        $file = request()->file('image');

        $filename = $file->getClientOriginalName();

        $file->move('images', $filename);//папка для загрузки изображения


        $article = Article::create([

            'user_id' => auth()->user()->id,

            'title' => request('title'),

            'body' => request('body')

        ]);


        if ($filename) {

            $artic = Article::find($article->id);

            $artic->image = '/images/' . $filename;

            $artic->save();
        }


        return redirect()->home();

    }


    public function edit($id)

    {

        $article = Article::findOrFail($id);

        return view('articles.edit', compact('article'));

    }


    public function update($id)

    {


        $this->validate(request(), [

            'title' => 'required',

            'body' => 'required'

        ]);


        $article = Article::find($id);

        $article->title = request('title');

        $article->body = request('body');

        $article->save();


        return redirect()->route('article_id', ['id' => $id]);

    }


    public function delete($id)

    {

        $article = Article::find($id);

        $article->delete();

        return redirect()->home();

    }


}
