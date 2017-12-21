@extends('app')


@section('header')

    {{ $article->title }}

@stop

@section('content')

    <div class="blog-post">

        <p class="blog-post-meta">

            {{ $article->user->name }} created at

            {{ $article->created_at->toDayDateTimeString() }}

        </p>


        @if ($article->created_at != $article->updated_at)

            <p class="blog-post-meta">

                Updated at {{ $article->updated_at->toDayDateTimeString() }}

            </p>

        @endif


        @if ($article->image)

            <div>

                <img src="{{ URL::asset( $article->image ) }}" class="img-rounded" height="70%" width="70%">

            </div>

        @endif


        <div class="body">

            <p>{{ $article->body }}</p>

        </div>

    </div>


    <hr/>


    @if (!Auth::guest() and auth()->user()->id == $article->user_id )

        <div class="form-group">

            <a href="/article/edit/{{ $article->id }}" class="btn btn-primary" role="button">Edit article</a>

            <a href="/article/delete/{{ $article->id }}" class="btn btn-primary" role="button">Delete</a>

        </div>

    @endif


    <div class="form-group">

        <a href="/" class="btn btn-primary" role="button">Back</a>

    </div>



    <div class="comment">


        <ul class="list-group">

            @foreach($article->comments as $comment)

                <li class="list-group-item">

                    {{ $comment->body  }}

                    <strong>

                        {{ $comment->created_at->diffForHumans() }} &nbsp;

                    </strong>

                </li>

            @endforeach

        </ul>


    </div>

@stop

