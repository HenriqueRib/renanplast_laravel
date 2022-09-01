@extends('layouts.site')

@section('headerData')
    <link rel="stylesheet" href="{{ asset('css/modules/contato.css') }}">
@endsection

@section('titlepage', 'Contato')
@section('meta-title', 'Página Contato')
@section('meta-description', 'Entre e acesse o site da RenanPlast')

@section('content')
    @php
    $esconde = 1;
    @endphp

    <div class="container">
        <div class="banner_principal">
            <div class="banner_texto">
                <h2 class="titulo">Contato</h2>
                <p>
                    Gostaria de obter maiores informações sobre O <b><i>renanplast</b></i>, entre em contato conosco.
                </p>
                <p>
                    Preencha os campos
                    abaixo que em breve retornaremos!
                </p>
                <p>
                    Esperamos por você!
                </p>
            </div>
            <div class="banner_img">
                <div class="img_contato" style="background-image: url('/img/site/banner/contato3.png')">
                    {{-- <img src="../img/site/banner/contato3.png" alt="imagem de contato"> --}}
                </div>
            </div>
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
            <div class="contato_card_center">
                <div class="contato_formulario">
                    <div class="input_function">
                        <form action="{{ route('contato_email') }}" method="POST" id="formulario">
                            @csrf
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" placeholder="Digite aqui seu nome" name="nome"
                                id="nome" required>
                            <label for="telefone">Número de telefone</label>
                            <input type="text" class="form-control" placeholder="00000-0000" name="telefone"
                                id="telefone" required>
                            <label for="E-mail">E-mail</label>
                            <input type="text" class="form-control" placeholder="seuemail@site.com.br" name="email"
                                id="email" onblur="valida()" required>
                            <div class="alert alert-danger email-validation hide-self">
                                Digite um e-mail valido
                            </div>
                            <label for="assunto">Assunto</label>
                            <input type="text" class="form-control" placeholder="Digite aqui o assunto" name="assunto"
                                id="assunto" required>
                            <label for="mensagem">Mensagem</label>
                            <textarea required class="form-control" placeholder="Digite aqui sua mensagem" rows="6" name="mensagem"
                                id="text" required></textarea>
                            <div class="contato_card_center">
                                <button type="submit" class="btn btn_enviar ">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
