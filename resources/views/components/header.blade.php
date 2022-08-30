<div class="container">
    <!-- Navigation -->
    <nav class="navbar navbar_personalizado navbar-expand-lg navbar-light static-top">
        <div class="desktop_none">

        </div>
        <div class="">
            <a class="logo_desktop" href="/">
                <img class="logo_mobile" src="/img/site/logo.png">
            </a>
        </div>
        <div class="menu">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="nav__site__menu collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ">
                    <li class="nav-item @if (Route::currentRouteName() == 'home') active @endif nav_titulo">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item @if (Route::currentRouteName() == 'produtos') active @endif nav_titulo">
                        <a class="nav-link" href="{{ route('produtos') }}">Produtos</a>
                    </li>
                    <li class="nav-item @if (Route::currentRouteName() == 'sobre') active @endif nav_titulo">
                        <a class="nav-link" href="{{ route('sobre') }}">Quem Somos</a>
                    </li>
                    <li class="nav-item @if (Route::currentRouteName() == 'contato') active @endif nav_titulo">
                        <a class="nav-link" href="{{ route('contato') }}">Contato</a>
                    </li>
                    <li class="nav-item nav_titulo">
                        <a class="nav-link" href="">
                            <i class="fab fa-whatsapp btn_whats"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
