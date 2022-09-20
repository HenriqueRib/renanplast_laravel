@extends('layouts.app')

@section('titlepage', 'Administradores')

@section('content')
    <div class="content-admin">
        @component('components.admin.nav')
        @endcomponent
        <div class="content card">
            <div class="card-header">
                <h1>Configuração</h1>
            </div>

            <div class="card card-body">
                <form id="formulario" action="{{ route('admin_configuracao_edit') }}" method="POST" class="form_config"
                    enctype="multipart/form-data">
                    @csrf

                    <div>
                        @if (Auth::user()->image != null)
                            <div class="config_img">
                                Imagem atual
                                <div class="img_config" style="background-image: url({{ asset(Auth::user()->image) }});">
                                </div>
                            </div>
                        @endif
                        <br>
                        @if (Auth::user()->banner_image != null)
                            <div class="config_img">
                                Banner atual
                                <div class="img_banner_config"
                                    style="background-image: url({{ asset(Auth::user()->banner_image) }});">
                                </div>
                            </div>
                        @endif
                    </div>
                    <div>
                        <div class="config_div_img">
                            <div>
                                <label
                                    for="image">{{ Auth::user()->image ? 'Escolher nova imagem perfil' : 'Escolher imagem perfil' }}
                                </label>
                                <input class="form-control py-1" type="file" accept="image/*" id="image"
                                    name="image">
                            </div>
                            <img id="image_real" class="miniatura">
                        </div>

                        <div class="config_div_img">
                            <div>
                                <label
                                    for="banner_image">{{ Auth::user()->image ? 'Escolher nova imagem banner' : 'Escolher imagem banner' }}
                                </label>
                                <input class="form-control py-1" type="file" accept="image/*" id="banner_image"
                                    name="banner_image">
                            </div>
                            <img id="image_real_banner" class="miniatura">
                        </div>

                        <div class="form-group">
                            <label for="name"> Alterar Nome</label>
                            <input value="{{ $users->name }}" required type="text" name="name" id="name"
                                class="form-control" maxlength="80">
                        </div>
                        <div class="form-group">
                            <label for="email">Alterar Email</label>
                            <input value="{{ $users->email }}" required type="text" name="email" id="email"
                                class="form-control" onblur="valida()">
                            <div class="alert alert-danger email-validation hide-self">
                                Digite um e-mail valido
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password"> Alterar Senha</label>
                            <input type="password" name="password" id="password" class="form-control" maxlength="80">
                        </div>

                        <div style="display: none">
                            <label for="id">Captura o id do Documento</label>
                            <input required value="{{ $users->id }}" type="text" name="id" id="id"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn_custom">Salvar
                                Usuario</button>
                            <button type="reset" class="btn btn_custom2">Limpar
                                Dados</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    @component('components.popup_automatico')
    @endcomponent

@endsection

@push('footerData')
    <script src='https://www.hCaptcha.com/1/api.js' async defer></script>

    <script>
        document.getElementById("image").onchange = function() {
            var reader = new FileReader();

            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("image_real").src = e.target.result;
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        };

        document.getElementById("banner_image").onchange = function() {
            var reader = new FileReader();

            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("image_real_banner").src = e.target.result;
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        };

        function validateTamanho() {
            if (document.getElementById('image').files[0].size > 5242880) {
                return true;

            } else {
                return false;
            }
        }

        $("#formulario").submit(function(event) {
            if (!isEmail($("#email").val())) {
                alert("Verifique o e-mail digitado e tente novamente!")
                event.preventDefault();
                return;
            }

            if (validateTamanho()) {
                alert("Sua imagem possui mais do que 5MB. Por gentileza utilize uma imagem menor.")
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
