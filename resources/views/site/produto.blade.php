@extends('layouts.site')

@section('headerData')
    <link rel="stylesheet" href="{{ asset('css/modules/produto.css') }}">
@endsection

@section('titlepage', 'Serviços')
@section('meta-title', 'Página Serviços aos associados')
@section('meta-description', 'Entre e acesse o site da RenanPlast')

@section('content')
    <div class="popup-home none">
        <div class="content">
            <i class="far fa-times-circle"></i>
            <img src>
        </div>
    </div>

    <div class="container">
        <div class="pesquisar">
            <div>
                <form action="{{ route('produtos_search') }}" method="POST" id="formulario" class="formulario_presquisar">
                    @csrf
                    <input type="text" class="form-control" placeholder="Pesquisar outro produto" name="pesquisa"
                        id="pesquisa" required>
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
                    {{-- <div class="current-image">
                        <img src="{{ $produto->image }}" alt="{{ $produto->nome }}">
                    </div> --}}
                    <div class="current-image">
                        <img class="imgtarget" src="{{ $produto->image }}" alt="{{ $produto->nome }}">
                    </div>
                    {{-- <div class="item" style="background-image: url('{{ asset($noticia->image) }}') ">
                        <img  src="{{ $noticia->image }}">
                        </div> --}}
                    <div class="thumbnails-track">
                        <div class="splide">
                            <div class="splide__track">
                                <div class="splide__list">
                                    <div class="thumbnail splide__slide">
                                        <button class="thumbnail-button" aria-current="true">
                                            <img src="{{ $produto->image }}" alt="{{ $produto->nome }}"
                                                data-full-alt="{{ $produto->nome }}">
                                        </button>
                                    </div>
                                    @foreach ($produto->foto_produto as $foto)
                                        <div class="thumbnail splide__slide">
                                            <button class="thumbnail-button">
                                                <img src="{{ $foto->imagem_produto }}">
                                            </button>
                                        </div>
                                    @endforeach
                                    {{-- <div class="thumbnail splide__slide">
                                        <button class="thumbnail-button">
                                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3609497/armando-castillejo-500x500.jpg"
                                                alt="image 3 of 5" data-full-alt="Succulents 3">
                                        </button>
                                    </div> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="produto_texto">
                <h3 class="titulo">{{ $produto->nome }}</h3>
                <div class="produto_linha">
                    @if ($produto->preco != null)
                        <h4>Preço: {{ $produto->preco }}</h4>
                    @else
                        <h4>&nbsp;</h4>
                    @endif
                    @if ($produto->estoque == 'Sim')
                        <p> <b> Em estoque </b></p>
                    @else
                        <p> <b> Sem estoque </b></p>
                    @endif
                </div>
                <div class="produto_linha">
                    @if ($produto->lote != null)
                        <p><b>Lote: {{ $produto->lote }}</b></p>
                    @else
                        <p>&nbsp;</p>
                    @endif
                    @if ($produto->serie != null)
                        <p><b>Serie: {{ $produto->serie }}</b></p>
                    @else
                    @endif
                </div>
                <br>
                <div class="produto_btn">
                    <p>
                        Para mais informações fale conosco pelo whatsapp
                    </p>
                    <a href="https://api.whatsapp.com/send?phone=5511953125814" class="link">
                        <button class="btn faleconosco_btn">
                            Fale conosco
                        </button>
                    </a>
                </div>
                <div class="descricao">
                    <div class="descricao_texto">
                        <h4>Descrição</h4>
                        <p>{{ $produto->descricao }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="descricao">
            <div class="descricao_texto">
                @if ($produto->modo != null)
                    <h4>Modo de uso</h4>
                    <p>{{ $produto->modo }}</p>
                @endif
                @if ($produto->medidas != null)
                    <h4>Medidas</h4>
                    <p>{{ $produto->medidas }}</p>
                @endif

                @if ($produto->modo == null && $produto->medidas == null)
                    <br>
                    <br> <br>
                    <br> <br>
                    <br>
                @endif

            </div>
        </div>
    </div>

@endsection

@push('footerData')
    <script>
        var currentImage;
        var splide;
        var previousButton, nextButton;
        var thumbnails, thumbnailButtons;

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

        const popup = document.querySelector('.popup-home');
        const content = document.querySelector('.popup-home .content');
        const close = document.querySelector('.popup-home .content i');
        const imgPopup = document.querySelector('.popup-home .content img');
        const imgs = document.querySelectorAll('.imgtarget');

        imgs.forEach((img) => {
            img.addEventListener('click', function() {
                if (popup.classList.contains('none')) {
                    imgPopup.src = img.src;
                    popup.classList.remove('none');
                    popup.style.animation = "opening .3s forwards";
                } else {
                    popup.style.animation = "close .3s forwards";
                    setTimeout(() => {
                        popup.classList.add('none');
                    }, 700)
                }
            })

            popup.addEventListener('click', function() {
                if (popup.classList.contains('none')) {
                    popup.classList.remove('none');
                    popup.style.animation = "opening .3s forwards";
                } else {
                    popup.style.animation = "close .3s forwards";
                    setTimeout(() => {
                        popup.classList.add('none');
                    }, 700)
                }
            })

            close.addEventListener('click', function() {
                if (popup.classList.contains('none')) {
                    popup.classList.remove('none');
                    popup.style.animation = "opening .3s forwards";
                } else {
                    popup.style.animation = "close .3s forwards";
                    setTimeout(() => {
                        popup.classList.add('none');
                    }, 700)
                }
            })

        })
    </script>
@endpush
