<!doctype html>
<html lang="en">

<head>


    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">

    <meta name="author" content="">


    <link rel="icon" href="../../../../favicon.ico">


    <title>Blog</title>


    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">


    <!-- Custom styles for this template -->
    <link href="/css/blog.css" rel="stylesheet">


</head>


<body>


<header>


    @include ('layouts.nav')


    <div class="blog-header">


        <div class="container">

            <h1 class="blog-title">

                @yield('header')

            </h1>

        </div>


    </div>
</header>


<main role="main" class="container">


    <div class="row">


        <div class="col-sm-8 blog-main">

            @yield('content')

        </div><!-- /.blog-main -->


        <aside class="col-sm-3 ml-sm-auto blog-sidebar">


            <div class="sidebar-module sidebar-module-inset">

                <h4>About</h4>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tincidunt egestas purus eu scelerisque.
                    Sed lacinia ullamcorper sodales. Nulla accumsan sollicitudin nisl, at luctus nibh blandit semper.
                    Nam ut massa faucibus, consequat dolor eget, suscipit libero. Duis nisi est, imperdiet et nisi eu,
                    malesuada lobortis lorem.</p>

            </div>


            <div class="sidebar-module">


                <h4>Archives</h4>

                <ol class="list-unstyled">

                    @foreach ($archives as $statistic)

                         <li>

                             <a href="/?month={{ $statistic['month'] }}&year={{ $statistic['year'] }}">

                                 {{ $statistic['month'] . ' ' . $statistic['year'] }}

                             </a>

                         </li>

                    @endforeach

                </ol>


            </div>





        </aside><!-- /.blog-sidebar -->


    </div><!-- /.row -->


</main><!-- /.container -->


@include ('layouts.footer')


</body>

</html>