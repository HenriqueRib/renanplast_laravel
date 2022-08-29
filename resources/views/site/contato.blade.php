@extends('layouts.site')

@section('headerData')
    <link rel="stylesheet" href="{{ asset('css/modules/contato.css') }}">
@endsection

@section('titlepage', 'Contato')
@section('meta-title', 'Página Contato')
@section('meta-description', 'Entre e acesse o site da RenanPlast')

@section('content')
    @php
    $esconde = 0;
    @endphp

    <div class="container banner_principal">
        <div class="banner_principal_texto">
            <div class="banner_titulo">
                <h2>Contato</h2>
            </div>
            <div>
                <p>
                    Texto
                </p>
                <p>
                    Esperamos por você!
                </p>
            </div>

        </div>
        <div class="banner_principal_imgs">
            <img class="banner_principal_img" src="/img/site/banner/parceiro.png">
        </div>
    </div>

    <div class="container mt-5" id="mensagem">
        @if (Session::has('status'))
            <div id="myModal" class="modal fade" id="modalExemplo" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Contato</h5>
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
            @php
                $esconde = 1;
            @endphp
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
                            <h5 class="modal-title" id="exampleModalLabel">Contato</h5>
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

    @if ($esconde == 1)
        <div class="container">
            <form action="{{ route('contato_email') }}" method="POST" id="formulario">
                @csrf
                <div>
                    <div class="titulo_dados_pessoais">
                        <h2>Dados Pessoais</h2>
                    </div>
                    <div>
                        <input class="form_parceiro form_nome" type="text" placeholder="Nome" name="name"
                            id="name" value="{{ old('name') }}" required>
                        <div>
                            <input class="form_parceiro form_email" type="text" placeholder="E-mail" name="email"
                                id="email" value="{{ old('email') }}" onblur="valida()" required>
                            <div class="alert alert-danger email-validation hide-self form_parceiro form_email"
                                style="margin: 1px">
                                Digite um e-mail valido
                            </div>
                        </div>
                        <div>
                            <input class="form_parceiro form_assunto" type="text" placeholder="Assunto" name="subject"
                                value="{{ old('subject') }}" id="subject">
                        </div>
                    </div>
                </div>
                <div>
                    <div class="titulo_mensagem">
                        <h2>Sua Mensagem</h2>
                    </div>
                    <div>
                        <textarea class="form_parceiro form_mensagem" type="text" rows="5" name="text" id="text">{{ old('text') }}</textarea>
                    </div>
                    <div class="g-recaptcha mt-5 " data-sitekey="6LfXj0seAAAAAK9QkpJ27rFipTE3t9VGHdlsvzgl"
                        data-callback="enableBtn"></div>
                    <button class="btn btn_enviar" disabled="disabled">
                        <b>Enviar </b>
                        &nbsp;
                        <img src="/img/site/icones/avancar.png">
                    </button>
                </div>
            </form>
        </div>
    @endif

@endsection

@push('footerData')
    <script>
        function enableBtn() {
            document.querySelector(".btn.btn_enviar").disabled = false;
        }
        // A $( document ).ready() block.
        $(document).ready(function() {
            resizeFooter();
        });
        $(window).resize(function() {
            resizeFooter();
        });


        function resizeFooter() {
            $("#contato").each(function() {
                $(this).css('height', this.clientWidth / 2.5)
            })
        }


        $("#formulario").submit(function(event) {
            if (!isEmail($("#email").val())) {
                alert("Verifique o e-mail digitado e tente novamente!")
                event.preventDefault();
                return;
            }
            if ($("#name").val().length == 0) {
                alert("Verifique o nome e tente novamente!")
                event.preventDefault();
                return;
            }
            if ($("#text").val().length == 0) {
                alert("Verifique a mensagem e tente novamente")
                event.preventDefault();
                return;
            }

        });

        function valida() {
            inputEmail = document.querySelector('#email');

            if (!isEmail(inputEmail.value)) {

                //enquanto digita, checa se o valor está certo e se sim, remove o alert red
                $('#email').keypress(function() {
                    if (isEmail(inputEmail.value)) {
                        document.querySelector('.email-validation').classList.add('hide-self');
                        inputEmail.classList.remove('is-invalid');
                    }
                });

                //adiciona alert red caso email incorreto
                document.querySelector('.email-validation').classList.remove('hide-self');
                inputEmail.classList.add('is-invalid');

            } else {
                //remove o alert red caso email certo
                document.querySelector('.email-validation').classList.add('hide-self');
                inputEmail.classList.remove('is-invalid');
            }
        }

        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
    </script>
@endpush
