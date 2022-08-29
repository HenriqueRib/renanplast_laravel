@extends('layouts.app')

@section('titlepage', 'Página Inicial Admin')

@section('content')
    <div class="content-admin">
        @component('components.admin.nav')
        @endcomponent
        <div class="content card">
            <h3 class="card-header">Bem-vindo(a) ao Painel de Administrador!</h3>
            <h4 class="card-body">Utilize o menu para navegar nas seções.</h4>
        </div>
    </div>

    @component('components.popup_automatico')
    @endcomponent
@endsection
