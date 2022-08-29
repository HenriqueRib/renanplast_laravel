@if (Session::has('pesquisa'))
    <div id="myModal" class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Resultado de sua pesquisa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert">
                        {{ Session::get('pesquisa') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    @push('footerData')
        <script>
            $(document).ready(function() {
                console.log("ready!");
                document.querySelector("#formulario").scrollIntoView();
            });
            $(window).on('load', function() {
                $('#myModal').modal('show');
            });
        </script>
    @endpush
@endif

@if (Session::has('status'))
    <div id="myModal" class="modal fade" id="modalExemplo" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Aviso </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success">
                        {{ Session::get('status') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    @push('footerData')
        <script>
            $(document).ready(function() {
                console.log("ready!");
                document.querySelector("#formulario").scrollIntoView();
            });
            $(window).on('load', function() {
                $('#myModal').modal('show');
            });
        </script>
    @endpush
@endif

@if (Session::has('error'))
    <div id="myModal" class="modal fade" id="modalExemplo" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Erro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>


    @push('footerData')
        <script>
            $(document).ready(function() {
                console.log("ready!");
                document.querySelector("#formulario").scrollIntoView();
                $(window).on('load', function() {
                    $('#myModal').modal('show');
                });
            });
            $(window).on('load', function() {
                $('#myModal').modal('show');
            });
        </script>
    @endpush
@endif


@if (Session::has('emailsucesso'))
    <div id="myModalSucesso" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Aviso </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success">
                        {{ Session::get('emailsucesso') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    @push('footerData')
        <script>
            $(document).ready(function() {
                console.log("ready!");
                document.querySelector("#formulario").scrollIntoView();
            });
            $(window).on('load', function() {
                $('#myModalSucesso').modal('show');
            });
        </script>
    @endpush
@endif

@if (Session::has('emailerro'))
    <div id="myModalErro" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Erro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        {{ Session::get('emailerro') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>


    @push('footerData')
        <script>
            $(document).ready(function() {
                console.log("ready!");
                document.querySelector("#formulario").scrollIntoView();
                $(window).on('load', function() {
                    $('#myModalErros').modal('show');
                });
            });
            $(window).on('load', function() {
                $('#myModalErro').modal('show');
            });
        </script>
    @endpush
@endif

<!-- Modal SalterarSenhaModal-->
<div class="modal fade" id="alterarSenha" tabindex="-1" role="dialog" aria-labelledby="alterarSenhaModal"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: #7f888c" id="alterarSenhaModal">Alterar Senha
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="display: none">
                <label for="id">Captura o id do Documento</label>
            </div>
            <form action="{{ route('user_edit') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="col-md-6">
                    </div>
                    <div style="display: none">
                        <label for="idUserSenha">Captura o Id do usuario</label>
                        <input class="form-control" type="text" id="idUserSenha" name="idUserSenha"
                            value="idUserSenha">
                    </div>
                    <div>
                        <label for="password">Nova Senha</label>
                        <input class="form-control" type="password" id="password" name="password">
                    </div>
                    <div style="margin: 15px 0">
                        <button type="submit" class="btn btn-success"
                            style="background-color: #1D3038; color:#fff">Salvar
                            Senha</button>
                    </div>

                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function params(e) {
        $("#idUser").val(e);
        $("#idUserSenha").val(e);
        $("#idUsuario").val(e);
    }
</script>
