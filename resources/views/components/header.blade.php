<div class="container">
    <!-- Navigation -->
    <nav class="navbar navbar_personalizado navbar-expand-lg navbar-light static-top">
        <div class="">
            <a class="logo_desktop" href="/">
                <img class="logo_mobile" src="/img/site/logo.png">
            </a>
        </div>
        <div class="menu">
            <div class="logo_mobile desktop_none">
                {{-- <button class="navbar-toggler btn_menu" type="button" data-toggle="collapse"
                    data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> --}}
    
                <input type="checkbox" id="checkbox4" class="checkbox4 visuallyHidden navbar-toggler btn_menu"
                    type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
                    aria-expanded="false" aria-label="Toggle navigation">
                <label for="checkbox4">
                    <div class="hamburger hamburger4">
                        <span class="bar bar1"></span>
                        <span class="bar bar2"></span>
                        <span class="bar bar3"></span>
                        <span class="bar bar4"></span>
                        <span class="bar bar5"></span>
                    </div>
                </label>
            </div>
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
