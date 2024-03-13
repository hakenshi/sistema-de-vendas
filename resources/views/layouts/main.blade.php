<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <title>@yield('title')</title>
</head>

<body>
    <header>

        <nav class="navbar navbar-expand navbar-color">
            <div class="container">
                <div class="collapse navbar-collapse justify-content-between">
                    <a href="/" class="navbar-brand p-3">
                        <img src="/assets/laravel.svg" id="img-header" alt="">
                        <span class="p-3">Home</span>
                    </a>
                    <ul class="navbar navbar-nav">
                        <li class="p-2 nav-item">
                            <span><a href="/login" class="nav-link">Login</a></span>
                        </li>
                        <li class="p-2 nav-item">
                            <span><a href="/register" class="nav-link">Registro</a></span>
                        </li>
                        @auth
                        <li class="p-2 nav-item">
                            <span><a href="/register" class="nav-link">Olá, usuário.</a></span>
                        </li>
                        @endauth
                        <li class="p-2 nav-item">
                            <a href="" class="nav-link"><span>
                                    <ion-icon class="icon" name="cart-outline"></ion-icon>
                                </span></a>
                        </li>
                        <li class="p-2 nav-item">
                            <span><a href="#" class="nav-link">Sair</a></span>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>
    <main>

        <div class="container">
            <div class="row">
                @yield('content')
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-5">
                    <small>&copy; project by: XD</small>
                </div>
            </div>
        </div>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="/js/jquery-3.7.1.min.js"></script>
    <script src="/js/script.js"></script>
</body>

</html>
