@extends('app')



@section('header')

    Sing In

@stop


@section('content')

    <form method="POST" action="/login">

        {{ csrf_field() }}

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Log in</button>
        </div>

        @include ('layouts.errors')

    </form>

@stop