<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <title>@yield('title')</title>

</head>

<body class="bg-light">

    @auth
        @php
            $user = auth()->user();
        @endphp
    @endauth
    <aside>
        <div id="sidebar">

            <div id="sidebar-content">
                <div id="user">
                    <img id="user_avatar" src="{{ $user->profile_photo_path ? '/storage/profile-photos/'. $user->profile_photo_path : '/assets/placeholder.png'  }}" alt="user-image">

                    <p id="user_infos">
                        <span class="item-description">
                            {{ $user->name }}
                        </span>
                        <span class="item-description">
                            {{ $user->user_type == 0 ? 'Admin' : 'Funcionário' }}
                        </span>
                    </p>
                </div>
                <ul id="side_items">
                    <li class="side_item">
                        <a href="/">
                            <ion-icon class="icon" name="home" style="padding: 0"></ion-icon>
                            <span class="item-description">Home</span>
                        </a>
                    </li>
                    @if ($user->user_type == 0)
                    <li class="side_item">
                        <a href="/registrar-produto">
                            <ion-icon class="icon" name="add" style="padding: 0"></ion-icon>
                            <span class="item-description">Cadastrar Produtos</span>
                        </a>
                    </li>

                    <li class="side_item">
                        
                        <a href="/listar-produtos" class="nav-link">
                            <ion-icon class="icon" name="cube" style="padding: 0"></ion-icon>
                            <span class="item-description">Estoque</span>
                        </a>

                    </li>

                    <li class="side_item">
                        <a href="/funcionarios">
                            <ion-icon class="icon" name="person" style="padding: 0"></ion-icon>
                            <span class="item-description">Ver usuarios</span>
                        </a>
                    </li>
                    
                    <li class="side_item">
                        
                        <a href="/register" class="nav-link">
                            <ion-icon class="icon" name="person-add" style="padding: 0"></ion-icon>
                            <span class="item-description">Registrar usuário</span>
                        </a>
                    </li>
                    <button id="open_btn"><ion-icon name="chevron-forward-outline"></ion-icon></button>
                    @else

                    <li class="side_item">
                        <a href="/venda/nova-venda">
                            <ion-icon class="icon" name="add" style="padding: 0"></ion-icon>
                            <span class="item-description">Nova Venda</span>
                        </a>
                    </li>
                    
                    <button id="open_btn"><ion-icon name="chevron-forward-outline"></ion-icon></button>
                    @endif
                </ul>

                <div class="side_item">

                    <form method="POST" action="/logout">
                        @csrf
                        <a href="/logout" class="nav-link"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <ion-icon class="icon" name="log-out-outline" style="padding: 0"></ion-icon>
                            <span class="item-description">Logout</span>
                        </a>
                    </form>

                    {{-- <a href="#">
                        <ion-icon class="icon" name="home" style="padding: 0"></ion-icon>
                        <span class="item-description">Logout</span>
                    </a> --}}
                </div>
            </div>
        </div>
    </aside>
    <main>

        <div class="container">
            <div class="row">
                @yield('content')
            </div>
        </div>
    </main>
    {{-- <footer class="mt-5">
        <small>&copy; project by: Felipe</small>
    </footer> --}}

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="/js/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="/js/script.js"></script>
    <script src="/js/ajax.js"></script>
</body>

</html>
