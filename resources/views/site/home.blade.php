@extends('layouts.site')

@section('headerData')
    <link rel="stylesheet" href="{{ asset('css/modules/home.css') }}">
@endsection

@section('titlepage', 'Home')
@section('meta-title', 'Página Home')
@section('meta-description', 'Entre e acesse o site da RenanPlast')

@section('content')
    @if ('/?q=1' != $_SERVER['REQUEST_URI'])
        <meta http-equiv="Refresh" content="0; url=/construcao" />
    @endif

    <div class="container">
        <div class="splide_banner">
            <div class="splide">
                <div class="splide__arrows">
                    <button class="splide__arrow splide__arrow--prev">
                    </button>
                    <button class="splide__arrow splide__arrow--next">
                    </button>
                </div>
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                            <div class="banner">
                                <div class="banner_img banner_img1" >
                                    <div class="banner_centralizar">
                                        <div class="banner_txt">
                                            <div class="banner_texto">
                                                <h3>Serviços Artesanais</h3>
                                                <h6>
                                                    Temos agulha mágica e muitos outros produtos que você já conhece. 
                                                </h6>
                                                <div class="center">
                                                    <a href="https://api.whatsapp.com/send?phone=5511953125814" target="_blank" class="link">
                                                        <button class="btn btn_fale_conesoco">
                                                            Fale conosco !
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="banner">
                                <div class="banner_img banner_img2">
                                    <div class="banner_centralizar">
                                        <div class="banner_txt">
                                            <div class="banner_texto">
                                                <h3>Fabricação Própria</h3>
                                                <h6>
                                                    Precisa de um produto personalizado? 
                                                </h6>
                                                <h6>    
                                                    Aqui você encontra!
                                                </h6>
                                                <div class="center">
                                                    <a href="https://api.whatsapp.com/send?phone=5511953125814" target="_blank" class="link">
                                                        <button class="btn btn_fale_conesoco">
                                                            Fale conosco ! 
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="banner">
                                <div class="banner_img banner_img3">
                                    <div class="banner_centralizar">
                                        <div class="banner_txt">
                                            <div class="banner_texto">
                                                <h3>Serviços com Plástico</h3>
                                                <h6>
                                                    Temos a nossa própria máquina injetora de plástico. 
                                                </h6>
                                                <h6>
                                                    Gostaria de utilizada por hora máquina? 
                                                </h6>
                                                <h6>
                                                    Traga seu molde e utilize a máquina.
                                                </h6>
                                                <div class="center">
                                                    <a href="https://api.whatsapp.com/send?phone=5511953125814" target="_blank" class="link">
                                                        <button class="btn btn_fale_conesoco">
                                                            Clique aqui para mais informação 
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
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

                @foreach ($produtos_principais as $produto)
                    <a href="/produto/{{ $produto->id }}" class="link">
                        <div class="card_produto">
                            <div class="card_img" style="background-image: url({{ asset($produto->image) }})">
                                {{-- <img alt="{{ $produto->nome }}"> --}}
                            </div>
                            <h5
                                style="padding-left: 20px;width: 95%; text-align:center; text-overflow: ellipsis; overflow:hidden; white-space: nowrap;">
                                {{ $produto->nome }}
                            </h5>
                            <p
                                style="padding-left: 20px;width: 95%; text-align:center; text-overflow: ellipsis; overflow:hidden; white-space: nowrap;">
                                {{ $produto->descricao }}
                            </p>
                        </div>
                    </a>
                @endforeach

                {{-- <div class="card_produto">
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
                </div> --}}
                @if ($produtos_principais->count() == 0)
                    <div class="center" style="margin: -50px 0 50px 0">
                        <h3 class="titulo">No momento nenhum produto foi cadastrado</h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="center">
        <a href="/produtos" class="link">
            <button class="btn btn_fale_conesoco">
                Veja mais produtos
            </button>
        </a>
    </div>

    <div class="efeito">
        <marquee behavior="scroll" direction="left" scrollamount="15">
            <div>
                <img class="corda" src="/img/site/icones/corda.png">
            </div>
        </marquee>
    </div>

    <div class="container">
        <h2 class="titulo">O que Fazemos</h2>
        <div class="fazemos">
            <div class="">
                <div>
                    <h5>Artesanato</h5>
                    <p>Informação</p>
                    <h5>Manuais</h5>
                    <p>Informação</p>
                    <h5>Plástico</h5>
                    <p>Informação</p>
                </div>
            </div>
            <div class="img_fazemos">
                <div class="imagem_fazemos">
                    <img src="/img/site/banner/produtos_oquefazemos.jpg" width="450" alt="imagem de amostra do produto">
                </div>
            </div>
        </div>
        <div class="center">
            <a href="https://api.whatsapp.com/send?phone=5511953125814" class="link" target="_blank">
                <button class="btn btn_fale_conesoco">
                    Solicite um orçamento
                </button>
            </a>
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
        <h2 class="titulo">Mais produtos</h2>
        <div class="mais_produtos">
            <div class="card_produtos">
                @foreach ($produtos as $produto)
                    <a href="/produto/{{ $produto->id }}" class="link">
                        <div class="card_produto">
                            <div class="card_img" style="background-image: url({{ asset($produto->image) }})">
                                {{-- <img alt="{{ $produto->nome }}"> --}}
                            </div>
                            <h5
                                style="padding-left: 20px;width: 95%; text-align:center; text-overflow: ellipsis; overflow:hidden; white-space: nowrap;">
                                {{ $produto->nome }}
                            </h5>
                            <p
                                style="padding-left: 20px;width: 95%; text-align:center; text-overflow: ellipsis; overflow:hidden; white-space: nowrap;">
                                {{ $produto->descricao }}
                            </p>
                        </div>
                    </a>
                @endforeach
                @if ($produtos->count() == 0)
                    <div class="center" style="margin: -50px 0 50px 0">
                        <h3 class="titulo">No momento nenhum produto foi cadastrado</h3>
                    </div>
                @endif
                {{-- <div class="card_produto">
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
                </div> --}}
            </div>
        </div>
        <div class="center" style="margin: -50px 0 50px 0">
            <a href="/produtos" class="link">
                <button class="btn btn_fale_conesoco">
                    Veja mais produtos
                </button>
            </a>
        </div>
    </div>

@endsection

@push('footerData')
    <script>
        new Splide('.splide', {
            type: 'loop',
            // direction: 'ttb',
            direction: 'rrb',
            height: '400px',
            speed: 1000,
            rewindSpeed: 5000,
            interval: 5000,
            autoplay: 'true',
            breakpoints: {
                600: {
                    direction: 'rrb',
                    perPage: 1,
                },
            },
        }).mount();

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
