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
                <form action="{{ route('produtos_search') }}" method="POST" id="formulario" class="formulario_presquisar">
                    @csrf
                    <input type="text" class="form-control" placeholder="Digite aqui o nome do produto" name="pesquisa"
                        id="pesquisa" required>
                    <button type="submit" class="btn">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @if ($search != null)
        <div class="container">
            <h2 class="titulo">Veja o que encontramos em sua pesquisa</h2>
            <div class="principal_produtos">
                <div class="card_produtos">
                    <div class="row" @if ($search->count() == 2) style="display: block" @endif>
                        @foreach ($search as $produto)
                            <div class="col-4 mt-5">
                                <a href="produto/{{ $produto->id }}" class="link">
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
                            </div>
                        @endforeach
                    </div>
                    @if ($search->count() == 0)
                        <div class="center" style="margin: -50px 0 50px 0">
                            <h3 class="titulo">Nenhum produto foi encontrado em sua pesquisa</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

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
                <div class="row">
                    @foreach ($produtos_principais as $produto)
                        <div class="col-4 mt-5">
                            <a href="produto/{{ $produto->id }}" class="link">
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
                        </div>
                    @endforeach
                </div>
                @if ($produtos_principais->count() == 0)
                    <div class="center" style="margin: -50px 0 50px 0">
                        <h3 class="titulo">No momento nenhum produto foi cadastrado</h3>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="efeito" style="margin-top: -40px ">
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
                <div class="row" style="justify-content: space-around;">
                    @foreach ($produtos as $produto)
                        <div class="col-4 mt-5">
                            <a href="produto/{{ $produto->id }}" class="link">
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
                        </div>
                    @endforeach
                </div>
                @if ($produtos->count() == 0)
                    <div class="center" style="margin: -50px 0 50px 0">
                        <h3 class="titulo">No momento nenhum produto foi cadastrado</h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="center" style="margin: 150px 0 0px 0">
        <div class="paginacao">
            @if ($produtos->count() != 0)
                <h1> {{ $produtos->withQueryString()->links() }}</h1>
            @endif
        </div>
    </div>
@endsection

@push('footerData')
@endpush
