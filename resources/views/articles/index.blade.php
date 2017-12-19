@extends('app')



@section('header')

    My Articles

@stop


@section('content')


    @foreach ($articles as $article)

        <div class="blog-post">


            <h2 class="blog-post-title">

                <a href='{{ url('article', $article->id ) }}'>{{ $article->title }}</a>

            </h2>


            <p class="blog-post-meta">

                {{ $article->user->name }} on

                {{ $article->created_at->toDayDateTimeString() }}

            </p>


            <div class="body">{{ $article->body }}</div>


        </div><!-- /.blog-post -->


    @endforeach

@stop

