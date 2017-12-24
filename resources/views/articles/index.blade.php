@extends('app')



@section('header')

    Articles

@stop


@section('content')


    @foreach ($articles as $article)


        {{ $article->check_article($article) }}

        <div class="blog-post">


            <h2 class="blog-post-title">

                <a href='{{ url('article', $article->id ) }}'>{{ $article->title }}</a>

            </h2>


            <p class="blog-post-meta">

                {{ $article->user->name }} on

                {{ $article->created_at->toDayDateTimeString() }}

            </p>


            <div class="body">{{ $article->body }}</div>

            <hr/>
            <div class="favorites">

                @if (! $article->isFavorited())
                    <form method="POST" action="article/{{ $article->id }}/favorites">

                        {{ csrf_field() }}

                        <button type="submit" class="btn btn-default">
                            {{ $article->favorites()->count() }} Like
                        </button>

                    </form>
                @endif

                @if ($article->isFavorited())
                    <form method="POST" action="article/{{ $article->id }}/unfavorites">

                        {{ csrf_field() }}

                        <button type="submit" class="btn btn-danger">
                            {{ $article->favorites()->count() }} Like
                        </button>

                    </form>
                @endif

            </div>
            <hr/>
        </div><!-- /.blog-post -->



    @endforeach

@stop

