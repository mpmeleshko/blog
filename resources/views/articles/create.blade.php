@extends('app')

@section('header')

    Publish new article

@stop

@section('content')

    <form method="POST" action="/articles" enctype = "multipart/form-data">

        {{ csrf_field() }}

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name='title'>
        </div>

        <div class="form-group">
            <label for="body">Body</label>
            <textarea id="body" name="body" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="image">File input</label>
            <input type="file" id="image" name="image">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Publish</button>
        </div>

        @include ('layouts.errors')

    </form>

@stop