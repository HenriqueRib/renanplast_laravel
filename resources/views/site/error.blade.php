@extends('layouts.app')

@if (Auth::user())

    @if (Auth::user()->email_verified_at == '')
        @section('content')
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <b>Atenção!</b>
                    </div>
                    <div class="card-body">
                        <h4>E-mail não verificado!</h4>
                        <p>Por gentileza, verifique sua caixa de entrada ou spam, e clique no link de verificação para
                            ativar sua conta.</p>
                    </div>
                </div>
            </div>
        @endsection
    @elseif(Auth::user()->level == 0)
        @section('content')
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <b>Atenção!</b>
                    </div>
                    <div class="card-body">
                        <h4>Somente administradores podem visualizar estas páginas!</h4>
                        <p>Caso necessite de acesso administrador, por gentileza, solicite este acesso ao Administrador da
                            RenanPlast.</p>
                    </div>
                </div>
            </div>
        @endsection
    @endif




@endif
