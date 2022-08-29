@extends('layouts.app')

@section('titlepage', 'Administradores')

@section('content')
    <div class="content-admin">
        @component('components.admin.nav')
        @endcomponent
        <div class="content card">
            <div class="card-header total">
                <span class="total">
                    <h2 class=" ">Usuários</h2>
                    <h2 style="margin: 0 2rem">
                        <a class="btn btn-success" style="background-color: #1D3038; color:#3FAF8F" data-toggle="collapse"
                            href="#openNewPost" role="button" aria-expanded="false" aria-controls="openNewPost">
                            Adicionar Usuário
                        </a>
                    </h2>
                </span>
                <h2>
                    <span>
                        Usuários: {{ $users->total() }}
                    </span>

                </h2>
            </div>

            <div class="collapse" id="openNewPost">
                <div class="card card-body">
                    <form action="{{ route('admin_add_user') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input required type="text" name="name" id="name" class="form-control"
                                maxlength="80">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input required type="text" name="email" id="email" class="form-control"
                                onblur="valida()">
                            <div class="alert alert-danger email-validation hide-self">
                                Digite um e-mail valido
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="level">Tipo</label>
                            <select required name="level" id="level" class="form-control">
                                <option selected disabled>Selecione o Tipo </option>
                                <option value="1">Admin</option>
                                <option value="0">Sem Tipo</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" style="background-color: #1D3038; color:#3FAF8F"
                                class="btn btn-success">Salvar Usuario</button>
                            <button type="reset" style="background-color: #3FAF8F; color:#1D3038" class="btn">Limpar
                                Dados</button>
                            <a class="btn btn-danger" data-toggle="collapse" href="#openNewPost" role="button"
                                aria-expanded="false" aria-controls="openNewPost">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-body items-administradores-admin">
                <form action="{{ route('admin_user_search') }}" method="POST" enctype="multipart/form-data"
                    class="search_administradores_users">
                    @csrf
                    <div class="form-input search_administradores_users_col1">
                        <small id="label1" class="form-text text-muted pl-1">
                            Procurar pelo nome
                        </small>
                        <input type="text" name="name" id="name" class="form-control" maxlength="80"
                            placeholder="Digite algo sobre o nome para filtrar" aria-describedby="label1"
                            @if (isset($paramsname)) value="{{ $paramsname }}" @endif>
                    </div>
                    <div class="form-input search_administradores_users_col2">
                        <small id="label2" class="form-text text-muted pl-1">
                            Procurar pelo e-mail
                        </small>
                        <input type="text" name="email" id="email" class="form-control"
                            placeholder="Digite algo sobre o e-mail para filtrar" aria-describedby="label2"
                            @if (isset($paramsemail)) value="{{ $paramsemail }}" @endif>
                    </div>
                    <div class="actions search_administradores_users_col3">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                <div class="header">
                    <div class="col1">
                        <h5>Nome</h5>
                    </div>
                    <div class="col2">
                        <h5>Email</h5>
                    </div>
                    <div class="col3">
                        <h5>Tipo</h5>
                    </div>
                    <div class="col5">
                        <h5>Ações</h5>
                    </div>
                </div>
                <div class="content">
                    @if (count($users) == 0)
                        <div class="item">
                            <h3 class="py-2 mb-0" style="text-align: center; width: 100%">Não há Usuário cadastrado.
                            </h3>
                        </div>
                    @endif

                    @foreach ($users as $user)
                        <div class="item">
                            <div class="col1">
                                <p>{{ $user->name }}</p>
                            </div>
                            <div class="col2">
                                <p>{{ $user->email }}</p>
                            </div>
                            <div class="col3">
                                <p>{{ $user->tipo }}</p>
                                @if (!$user->tipo)
                                    @php
                                        switch ($user->level) {
                                            case 0:
                                                $user->tipo = 'Sem atribuição';
                                                break;
                                            case 1:
                                                $user->tipo = 'Administrador';
                                                break;
                                        }
                                    @endphp
                                    <p>{{ $user->tipo }}</p>
                                @endif
                            </div>
                            <div class="col5">
                                <div class="actions">
                                    <div class="dropleft">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fas fa-bars"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                            @if ($user->level == 0)
                                                <form action="{{ route('admin_add') }}" method="POST"
                                                    onsubmit="return confirm('Tem certeza que deseja tornar Administrador?')">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                                    <button type="submit" class="btn btn-success"
                                                        style="background-color: #1D3038; color:#3FAF8F">Tornar
                                                        Admin</button>
                                                </form>
                                                {{-- <form action="{{ route('admin_add_responsavel') }}" method="POST"
                                                    onsubmit="return confirm('Tem certeza que deseja tornar Administrador?')">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                                    <button type="submit" class="btn btn-success"
                                                        style="background-color: #1d2138; color:#3FAF8F">Tornar
                                                        Responsável</button>
                                                </form> --}}
                                            @elseif($user->level == 1 and $user->id != Auth::user()->id)
                                                <form action="{{ route('admin_remove') }}" method="POST"
                                                    onsubmit="return confirm('Tem certeza que deseja remover Administrador?')">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                                    <button type="submit" class="btn btn_custom">Remover Admin</button>
                                                </form>
                                            @elseif($user->id == Auth::user()->id)
                                                <form
                                                    onsubmit="return confirm('Tem certeza que deseja remover Administrador?')">
                                                    <button disabled="disabled" class="btn btn_custom">Remover
                                                        Admin</button>
                                                </form>
                                            @endif
                                            {{-- botão para visualizar informações de responsavel --}}
                                            @if ($user->level == 2)
                                                <a data-toggle="collapse" href="#collapse_id_{{ $user->id }}"
                                                    role="button" aria-expanded="false" style="padding:0 2px 4px 2px;"
                                                    aria-controls="collapse_id_{{ $user->id }}">
                                                    <button style="width: 100%; background-color:  #1d2738;; color: #fff"
                                                        class="btn ">
                                                        Visualizar </i>
                                                    </button>
                                                </a>
                                            @endif

                                            {{-- apenas quando representante estiver ativado --}}
                                            @if ($user->level == 2 && $user->representante->status == 0)
                                                {{-- <form action="{{ route('desativar_representante') }}" method="POST"
                                                    onsubmit="return confirm('Tem certeza que deseja desativar Responsável?')">
                                                    @csrf
                                                    <input type="hidden" name="id"
                                                        value="{{ $user->representante->id }}">
                                                    <button class="btn btn_custom">Desativar Responsável</button>
                                                </form> --}}
                                                <a href="" data-toggle="modal"
                                                    style="background-color: rgb(71, 17, 55);
                                                    padding: 7px 0px;
                                                    text-align: center;
                                                    border-radius: 5px;
                                                    color: white;
                                                    text-decoration: none;
                                                    margin: 2px 0 5px 2px;
                                                    width: 155px;"
                                                    data-target="#desativarResponsavel"
                                                    onclick="params({{ $user->representante->id }})">
                                                    Desativar
                                                </a>
                                            @endif
                                            {{-- apenas quando representante estiver desativado --}}
                                            @if ($user->level == 2 && $user->representante->status == 1)
                                                <form action="{{ route('ativar_representante') }}" method="POST"
                                                    onsubmit="return confirm('Tem certeza que deseja ativar Responsável?')">
                                                    @csrf
                                                    <input type="hidden" name="id"
                                                        value="{{ $user->representante->id }}">
                                                    <button class="btn btn_custom">Ativar Responsável</button>
                                                </form>
                                            @endif

                                            @if ($user->id == Auth::user()->id)
                                                <form onsubmit="return confirm('Tem certeza que deseja remover Usuário?')">
                                                    @csrf
                                                    <button disabled class="btn btn-danger"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            @else
                                                <a href="" data-toggle="modal" style="padding:0 2px 4px 2px;"
                                                    data-target="#alterarSenha" onclick="params({{ $user->id }})">
                                                    <button style="width: 100%; background-color: #555555; color: #fff"
                                                        class="btn">Alterar Senha
                                                    </button>
                                                </a>
                                                <form action="{{ route('user_delete') }}" method="POST"
                                                    onsubmit="return confirm('Tem certeza que deseja remover Usuário?')">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="collapse" id="collapse_id_{{ $user->id }}">

                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="card card-body">
                                <div style="display: flex;">
                                    <div class="form-group visualizar">
                                        <label for="title"><b>Nome Completo</b></label>
                                        <p>
                                            {{ $user->name }}
                                        </p>
                                    </div>
                                    <div class="form-group visualizar">
                                        <label for="title"><b>E-mail</b></label>
                                        <p>
                                            {{ $user->email }}
                                        </p>
                                    </div>
                                    <div class="form-group visualizar">
                                        <label for="title"><b>Celular</b></label>
                                        <p>
                                            @if ($user->representante)
                                                {{ $user->representante->cell_phone }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="form-group visualizar">
                                        <label for="title"><b>Telefone</b></label>
                                        <p>
                                            @if ($user->representante)
                                                {{ $user->representante->telephone }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div style="display: flex;">
                                    <div class="form-group visualizar" style="display: flex; flex-direction: column;">
                                        <label for="title"><b>RG (Identidade)</b></label>
                                        <p>
                                            @if ($user->representante)
                                                {{ $user->representante->rg }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="form-group visualizar">
                                        <label for="title"><b>CPF</b></label>
                                        <p>
                                            @if ($user->representante)
                                                {{ $user->representante->cpf }}
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                @if ($user->representante)
                                    <div style="display: flex;">
                                        <div class="form-group visualizar" style="display: flex; flex-direction: column;">
                                            @if ($user->representante->name_empresa)
                                                <label for="title"><b>Nome da Empresa </b></label>
                                                <p>
                                                    {{ $user->representante->name_empresa }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="form-group visualizar">
                                            @if ($user->representante->email_empresa)
                                                <label for="title"><b>E-mail da Empresa</b></label>
                                                <p>
                                                    {{ $user->representante->email_empresa }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="form-group visualizar">
                                            @if ($user->representante->cell_phone_empresa)
                                                <label for="title"><b>Telefone da Empresa</b></label>
                                                <p>
                                                    {{ $user->representante->cell_phone_empresa }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if ($user->representante)
                                    @if ($user->representante->trabalha_corretora == 'sim')
                                        <div style="display: flex;">
                                            <div class="form-group visualizar"
                                                style="display: flex; flex-direction: column;">
                                                <label for="title"><b>Nome corretora que trabalha</b></label>
                                                <p>
                                                    @if ($user->representante)
                                                        {{ $user->representante->name_corretora }}
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="form-group visualizar">
                                                <label for="title"><b>Telefone da corretora</b></label>
                                                <p>
                                                    @if ($user->representante)
                                                        {{ $user->representante->cell_phone_corretora }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <h5> <b> Endereço corretora </b></h5>
                                        <div style="display: flex;">
                                            <div class="form-group visualizar">
                                                <label for="title"><b>CEP</b></label>
                                                <p>
                                                    @if ($user->representante)
                                                        {{ $user->representante->cep }}
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="form-group visualizar">
                                                <label for="title"><b>Endereço</b></label>
                                                <p>
                                                    @if ($user->representante)
                                                        {{ $user->representante->street }}
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="form-group visualizar">
                                                <label for="title"><b>Número</b></label>
                                                <p>
                                                    @if ($user->representante)
                                                        {{ $user->representante->number }}
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="form-group visualizar">
                                                <label for="title"><b>Bairro</b></label>
                                                <p>
                                                    @if ($user->representante)
                                                        {{ $user->representante->district }}
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="form-group visualizar">
                                                <label for="title"><b>Complemento</b></label>
                                                <p>
                                                    @if ($user->representante)
                                                        {{ $user->representante->complement }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                            </div>

                            <div class="form-group">
                                <a class="btn btn-danger" data-toggle="collapse" href="#collapse_id_{{ $user->id }}"
                                    role="button" aria-expanded="false"
                                    aria-controls="collapse_id_{{ $user->id }}">Fechar</a>
                            </div>
                            </form>
                        </div>
                    @endforeach
                </div>

                <div class="container">
                    <div>
                        <div class="paginacao">
                            <h1> {{ $users }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @component('components.popup_automatico')
    @endcomponent

@endsection

@push('footerData')
    <script src='https://www.hCaptcha.com/1/api.js' async defer></script>

    <script>
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

<style>
    .hide-self {
        display: none;
    }

    .is-invalid {
        background-color: red;
        color: #737373;
    }
</style>
