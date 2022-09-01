@extends('layouts.site')

@section('headerData')
    <link rel="stylesheet" href="{{ asset('css/modules/sobre.css') }}">
@endsection

@section('titlepage', 'Sobre')
@section('meta-title', 'Página Sobre')
@section('meta-description', 'Entre e acesse o site da RenanPlast')

@section('content')
    <div class="container">
        <div class="banner_principal">
            <div class="banner_texto">
                <h2 class="titulo">Quem Somos</h2>
                <p>
                    A <b><i>renanplast</b></i>, localizada em Arujá atende as demandas principalmente localizada na grande
                    São Paulo e regiões.
                </p>
                <p>
                    Nosso diferencial são os produtos de fabricação própria que por ser de plástico não possui validade de
                    vencimento. Para mais informações entre em contato conosco pelo whatsapp ou pelo e-mail.
                </p>
                <p>
                    Somos especializados na fabricação dos produtos, Agulha mágica, Estojo e muitos outros. Estamos prontos
                    e a disposição para atender.
                </p>
            </div>
            <div class="banner_img">
                <div class="img_contato">
                    <img src="../img/site/banner/empresa2.jpg" alt="imagem da empresa">
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="content-servicos-4">
            <div class="card-container">
                <div class="each-card">
                    <h2>&nbsp;&nbsp;&nbsp;Missão: </h2>
                    <p>
                        Proporcionar ao maior número de pessoas uma experiência memorável e excelência em produtos e
                        serviços,
                        oferecendo qualidade e pontualidade em nossas entregas.
                    </p>
                </div>

                <div class="each-card">
                    <h2>&nbsp;&nbsp;&nbsp;Visão: </h2>
                    <p>
                        Ser referência na execução dos processos, visando a sustentabilidade ecológica como principal
                        ferramenta,
                        para atender nossos parceiros e clientes.
                    </p>
                </div>

                <div class="each-card">
                    <h2>&nbsp;&nbsp;&nbsp;Valores: </h2>
                    <ul>
                        <li>
                            <p>Comprometimento e Ética</p>
                        </li>
                        <li>
                            <p>Integridade e honestidade,</p>
                        </li>
                        <li>
                            <p>Valorização na entrega.</p>
                        </li>
                    </ul>
                    <br>
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
