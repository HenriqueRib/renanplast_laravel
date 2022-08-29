<div class="container mt-5">
    @if (Session::has('status'))
        <div id="myModal" class="modal fade" id="modalExemplo" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Aviso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success">
                            {{ Session::get('status') }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
        @push('footerData')
            <script>
                $(document).ready(function() {
                    console.log("ready!");
                    document.querySelector("#formulario").scrollIntoView();
                });
                $(window).on('load', function() {
                    $('#myModal').modal('show');
                });
            </script>
        @endpush
    @endif

    @if (Session::has('error'))
        <div id="myModal" class="modal fade" id="modalExemplo" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Aviso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
        @push('footerData')
            <script>
                $(document).ready(function() {
                    console.log("ready!");
                    document.querySelector("#formulario").scrollIntoView();
                    $(window).on('load', function() {
                        $('#myModal').modal('show');
                    });
                });
            </script>
        @endpush
    @endif
</div>
<div class="mt-5"></div>

<div class="mapa_contato">
    {{-- <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7310.743180387792!2d-46.64181687497279!3d-23.62685993860127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce5af8ce2106b7%3A0x6a10fdda79ceb31d!2sAv.%20Fagundes%20Filho%2C%201-721%20-%20Vila%20Monte%20Alegre%2C%20S%C3%A3o%20Paulo%20-%20SP%2C%2004304-010!5e0!3m2!1spt-BR!2sbr!4v1641411564131!5m2!1spt-BR!2sbr"
        width="65%" height="400" style="border:0; margin: 25px 0"></iframe> --}}
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7310.745307006449!2d-46.641211674972745!3d-23.626821838601714!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce57464ec55631%3A0x38a2f27fafd70ef6!2sAssocia%C3%A7%C3%A3o%20Brasileira%20de%20Bachar%C3%A9is%20em%20Direito%20Abbdir!5e0!3m2!1spt-BR!2sbr!4v1638992562144!5m2!1spt-BR!2sbr"
        width="65%" height="400" style="border:0; margin: 25px 0"></iframe>
    <div>
        <div class="fundo_contato">
            <img src="/img/site/card/fundo_contato.png">
        </div>
        <div class="formulario">
            <div>
                <ul class="">
                    <li class="nav_titulo2" style="display: flex; align-items: baseline;">
                        @if (Route::currentRouteName() == 'home')
                            <img src="/img/site/icones/item.png">
                        @endif
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav_titulo2" style="display: flex; align-items: baseline;">
                        @if (Route::currentRouteName() == 'sobre')
                            <img src="/img/site/icones/item.png">
                        @endif
                        <a class="nav-link" href="{{ route('sobre') }}">Sobre</a>
                    </li>
                    <li class="nav_titulo2" style="display: flex; align-items: baseline;">
                        @if (Route::currentRouteName() == 'produtos')
                            <img src="/img/site/icones/item.png">
                        @endif
                        <a class="nav-link" href="{{ route('produtos') }}">Serviços aos associados</a>
                    </li>

                    <li class="nav_titulo2" style="display: flex; align-items: baseline;">
                        @if (Route::currentRouteName() == 'contato')
                            <img src="/img/site/icones/item.png">
                        @endif
                        <a class="nav-link" href="{{ route('contato') }}">Contato</a>
                    </li>

                </ul>
            </div>
            {{-- Formulario pronto --}}
            {{-- <form action="{{ route('contato_email') }}" class="formulario_form" method="POST" id="formulario">
                @csrf
                <input type="text" class="form_especifico" placeholder="Nome" name="name" id="name" required>
                <input type="text" class="form_especifico" placeholder="E-mail" name="email" id="email"
                    onblur="valida()" required>
                <div class="alert alert-danger email-validation hide-self">
                    Digite um e-mail valido
                </div>
                <textarea required class="form_especifico" placeholder="Mensagem" rows="5" name="text"
                    id="text"></textarea>
                <button type="submit" class="btn btn-warning" style="border-color: #fff; color: #fff; background-color: #000;border-radius: 2rem;
                    width: 100px;">Enviar</button>
            </form> --}}
            <div class="texto texto_mobile">
                <img src="{{ asset('img/site/icones/telefone.png') }}" alt="telefone">
                <br>
                <b class="titulo">Telefones</b>
                <a class="link" href="https://api.whatsapp.com/send?phone=5511933957514">
                    <br> <i style="margin:0 5px; color:#25d366; font-size: 20px" class="fab fa-whatsapp"
                        aria-hidden="true"></i>(11) 9
                    3395-7514
                </a>
                <br>Fixo: (11) 3045-2406
                <br>Fixo: (11) 3045-2634
                <br>
                <img src="{{ asset('img/site/icones/email.png') }}">
                <br>
                <b class="titulo">E-mail</b>
                <br><a href="mailto:contato@renaplast.com.br"
                    style="text-decoration: none; color: #000000;">contato@renaplast.com.br</a>
                <br>
                <img src="{{ asset('img/site/icones/localizar.png') }}">
                <br>
                <b class="titulo">Endereço</b>
                <br>Av. Fagundes Filho, n° 141 – Sala 89, Denver
                <br>Vila Monte Alegre – SP
                <br>CEP: 04304-010.
                <div class="logocode">
                    <a href="https://codeline43.com.br/" target="_blanck">
                        <img src="{{ asset('img/site/logocode.png') }}">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
