@extends('app')


@section('header')

    {{ $article->title }}

@stop

@section('content')


    <div class="blog-post">

        <div>
            <p class="blog-post-meta">
                {{ $article->user->name }} created at
                {{ $article->created_at->toDayDateTimeString() }}
            </p>

            @if ($article->created_at != $article->updated_at)
                <p class="blog-post-meta">
                    Updated at {{ $article->updated_at->toDayDateTimeString() }}
                </p>
            @endif

        </div>

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

    <div class="favorites">

        @if (! $article->isFavorited())
            <form method="POST" action="{{ $article->id }}/favorites">

                {{ csrf_field() }}

                <button type="submit" class="btn btn-default">
                    {{ $article->favorites()->count() }} Like
                </button>

            </form>
        @endif

        @if ($article->isFavorited())
            <form method="POST" action="{{ $article->id }}/unfavorites">

                {{ csrf_field() }}

                <button type="submit" class="btn btn-danger">
                    {{ $article->favorites()->count() }} Like
                </button>

            </form>
        @endif

    </div>

    <hr/>


    <div class="form-group">

            <a href="/article/edit/{{ $article->id }}" class="btn btn-primary" role="button">Edit article</a>

        @if(Session::has('message'))
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                {{Session::get('message')}}
            </div>
        @endif

        @if (!Auth::guest() and auth()->user()->id == $article->user_id )
            <a href="/article/delete/{{ $article->id }}" class="btn btn-primary" role="button">Delete</a>
        @endif

    </div>


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

