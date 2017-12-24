<div class="blog-masthead">


    <div class="container">


        <nav class="nav">

            <a class="nav-link active" href="/">All articles</a>


            @if (! Auth::check())
                <a class="nav-link ml-auto" href="/login">Log in</a>
                <a class="nav-link" href="/registration">Registration</a>
            @endif


            @if (Auth::check())
                <a class="nav-link" href="/articles/create">Create new article</a>
                <a class="nav-link ml-auto" href="#">Hello, {{ Auth::user()->name }}</a>
                <a class="nav-link" href="/logout">Logout</a>
            @endif


        </nav>

    </div>


</div>
