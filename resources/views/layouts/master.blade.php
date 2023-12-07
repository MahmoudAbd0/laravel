<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href= "{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href= "{{ asset('css/category.css') }}" rel="stylesheet">
    <link href= "{{ asset('css/pagination.css') }}" rel="stylesheet">


    <title>@yield('title', 'Page')</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary"data-bs-theme="dark">
        <div class="container-fluid container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('products.index') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">Categories</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li> --}}
                    <form action="" method="get">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Language
                            </a>
                            <ul class="dropdown-menu">
                                @foreach (config('app.available_locales') as $language => $locale)
                                    <li><a type="submit" class="dropdown-item"
                                            href="{{ route('chanageLang') . '?lang=' . $locale }}">{{ $language }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </li>
                    </form>
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
