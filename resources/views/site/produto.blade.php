@extends('layouts.site')

@section('headerData')
    <link rel="stylesheet" href="{{ asset('css/modules/produto.css') }}">
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

    <div class="container">
        <div class="destaque_produto">
            <div class="carrosel_produto">
                <section class="carousel" aria-label="carousel">
                    <div class="current-image">
                        <img src="../img/site/logo.png" alt="Succulents 1">
                    </div>
                    <div class="thumbnails-track">
                        <div class="splide">
                            <div class="splide__track">
                                <div class="splide__list">
                                    <div class="thumbnail splide__slide">
                                        <button class="thumbnail-button" aria-current="true">
                                            <img src="../img/site/logo.png" alt="image 1 of 5" data-full-alt="Succulents 1">
                                        </button>
                                    </div>

                                    <div class="thumbnail splide__slide">
                                        <button class="thumbnail-button">
                                            <img src="../img/site/logo.png" alt="image 2 of 5" data-full-alt="Succulents 2">
                                        </button>
                                    </div>

                                    <div class="thumbnail splide__slide">
                                        <button class="thumbnail-button">
                                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3609497/armando-castillejo-500x500.jpg"
                                                alt="image 3 of 5" data-full-alt="Succulents 3">
                                        </button>
                                    </div>

                                    <div class="thumbnail splide__slide">
                                        <button class="thumbnail-button">
                                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3609497/calle-macarone-500x500.jpg"
                                                alt="image 4 of 5" data-full-alt="Succulents 4">
                                        </button>
                                    </div>

                                    <div class="thumbnail splide__slide">
                                        <button class="thumbnail-button">
                                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3609497/annie-spratt-500x500.jpg"
                                                alt="image 5 of 5" data-full-alt="Succulents 5">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="produto_texto">
                <h3 class="titulo">Nome do produto</h3>
                <div class="produto_linha">
                    <h4>Preço</h4>
                    <p>Em estoque</p>
                </div>
                <div class="produto_btn">
                    <p>
                        Para mais informações fale conosco pelo whatsapp
                    </p>
                    <a href="" class="link">
                        <button class="btn faleconosco_btn">
                            Fale conosco
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('footerData')
    <script>
        // var currentImage;
        // var splide;
        // var previousButton, nextButton;
        // var thumbnails, thumbnailButtons;

        window.addEventListener('DOMContentLoaded', function(e) {
            currentImage = document.querySelector('.current-image');
            previousButton = document.querySelector('.carousel .previous-button');
            nextButton = document.querySelector('.carousel .next-button');
            thumbnails = document.querySelectorAll('.carousel .thumbnail');
            thumbnailButtons = document.querySelectorAll('.carousel .thumbnail-button');

            thumbnailButtons.forEach(function(thumbnailButton) {
                thumbnailButton.addEventListener('click', function(e) {
                    activateThumbnail(thumbnailButton);
                });
            });

            splide = new Splide('.splide', {
                gap: '1px',
                padding: {
                    left: '25px',
                    right: '25px'
                },
                arrows: false,
                perPage: 5,
                pagination: false,
                keyboard: false,
                slideFocus: false,
            }).mount();
            // splide.on('move', function() {
            //     var slides = document.querySelectorAll('.splide .splide__slide');
            //     slides.forEach(function(slide) {
            //         slide.classList.add('is-visible');
            //     });
            // });
            // // Go to the previous slide when the Previous button is activated
            // previousButton.addEventListener('click', function(e) {
            //     splide.go('<');
            // });
            // Go to the next slide when the Next button is activated
            // nextButton.addEventListener('click', function(e) {
            //     splide.go('>');
            // });
        });

        function activateThumbnail(thumbnailButton) {
            var newImageSrc = thumbnailButton.querySelector('img').getAttribute('src');
            var newImageAlt = thumbnailButton.querySelector('img').getAttribute('data-full-alt');
            currentImage.querySelector('img').setAttribute('src', newImageSrc);
            currentImage.querySelector('img').setAttribute('alt', newImageAlt);
            thumbnailButtons.forEach(function(button) {
                button.removeAttribute('aria-current');
            });
            thumbnailButton.setAttribute('aria-current', true);
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
