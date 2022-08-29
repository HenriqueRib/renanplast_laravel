<div class="wrapper d-flex align-items-stretch content__menu">
    <nav id="sidebar">
        <div class="custom-menu">
            <button type="button" id="sidebarCollapse" class="btn btn-primary btn-primary-menu">
                <span class="menu">
                    Menu
                </span>
            </button>
        </div>
        <div class="img bg-wrap text-center py-4" style="background-image: url({{ asset(Auth::user()->banner_image) }});">
            <div class="user-logo">
                <div class="img_perfil" style="background-image: url({{ asset(Auth::user()->image) }});"></div>
                <h3>{{ Auth::user()->name }}</h3>
            </div>
        </div>
        <ul class="list-unstyled components mb-5">
            <li class="@if (Route::currentRouteName() == 'admin_index') active @endif">
                <a href="{{ route('admin_index') }}"><span class="fa fa-home mr-3"></span> Home</a>
            </li>
            @if (Auth::user()->level == 1)
                <li class="@if (Route::currentRouteName() == 'admin_administradores') active @endif">
                    <a href="{{ route('admin_administradores') }}"><span class="fas fa-user-shield mr-3"></span>
                        Usuários</a>
                </li>
            @endif
            <li class="@if (Route::currentRouteName() == 'admin_configuracao') active @endif">
                <a href="{{ route('admin_configuracao') }}"><span class="fa fa-cog mr-3"></span> Configuração</a>
            </li>
            <li>
                <a href="/"><span class="fas fa-pager mr-3"></span> Site</a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="fa fa-sign-out mr-3"></span> Sair</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
            <div class="card-body" style="margin: 0 5px">
                <a href="https://codeline43.com.br/" target="_blank">
                    <img src="/img/site/logocode.png" width="50%">
                </a>
            </div>
        </ul>
    </nav>
</div>
