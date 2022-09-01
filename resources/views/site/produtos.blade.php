@extends('layouts.site')

@section('headerData')
    <link rel="stylesheet" href="{{ asset('css/modules/produtos.css') }}">
@endsection

@section('titlepage', 'Serviços')
@section('meta-title', 'Página Serviços aos associados')
@section('meta-description', 'Entre e acesse o site da RenanPlast')

@section('content')

    <div class="container">
        <div class="pesquisar">
            <div>
                <form action="{{ route('contato_email') }}" method="POST" id="formulario" class="formulario_presquisar">
                    @csrf
                    <input type="text" class="form-control" placeholder="Digite aqui o nome do produto" name="produto"
                        id="produto" required>
                    <button type="submit" class="btn">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="efeito">
        <marquee behavior="scroll" direction="right" scrollamount="15">
            <div>
                <img class="corda" src="/img/site/icones/corda.png">
            </div>
        </marquee>
    </div>

    <div class="container">
        <h2 class="titulo">Nosso principais produtos</h2>
        <div class="principal_produtos">
            <div class="card_produtos">
                <div class="card_produto">
                    <div class="card_img">
                        <img src="" alt="produto 1">
                    </div>
                    <h5>Nome Produto</h5>
                    <p>Descrição produto</p>
                </div>
                <div class="card_produto">
                    <div class="card_img">
                        <img src="" alt="produto 1">
                    </div>
                    <h5>Nome Produto</h5>
                    <p>Descrição produto</p>
                </div>
                <div class="card_produto">
                    <div class="card_img">
                        <img src="" alt="produto 1">
                    </div>
                    <h5>Nome Produto</h5>
                    <p>Descrição produto</p>
                </div>
            </div>
        </div>
    </div>

    <div class="efeito">
        <marquee behavior="scroll" direction="left" scrollamount="15">
            <div>
                <img class="corda" src="/img/site/icones/corda.png">
            </div>
        </marquee>
    </div>


    <div class="container">
        <h2 class="titulo">Mais produtos</h2>
        <div class="mais_produtos">
            <div class="card_produtos">
                <div class="card_produto">
                    <div class="card_img">
                        <img src="" alt="produto 1">
                    </div>
                    <h5>Nome Produto</h5>
                    <p>Descrição produto</p>
                </div>
                <div class="card_produto">
                    <div class="card_img">
                        <img src="" alt="produto 1">
                    </div>
                    <h5>Nome Produto</h5>
                    <p>Descrição produto</p>
                </div>
                <div class="card_produto">
                    <div class="card_img">
                        <img src="" alt="produto 1">
                    </div>
                    <h5>Nome Produto</h5>
                    <p>Descrição produto</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footerData')
    <script>
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
