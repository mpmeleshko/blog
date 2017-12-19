@extends('app')

@section('header')

    Edit article

@stop

@section('content')


    <form method="POST" action="/article/edit/{{ $article->id }}">

        {{ csrf_field() }}


        <p class="blog-post-meta">

            {{ $article->user->name }} on

            {{ $article->created_at->toDayDateTimeString() }}

        </p>


        <div class="form-group">

            <label for="title">Title</label>

            <input type="text" class="form-control" id="title" name='title' value="{{ $article->title }}">

        </div>


        <div class="form-group">

            <label for="body">Body</label>

            <textarea id="body" name="body" class="form-control"> {{ $article->body }}</textarea>

        </div>


        <div class="form-group">

            <button type="submit" class="btn btn-primary">Update</button>

        </div>


        @include ('layouts.errors')


    </form>


@stop