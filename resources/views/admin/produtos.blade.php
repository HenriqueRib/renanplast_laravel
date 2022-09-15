@extends('layouts.app')

@section('titlepage', 'Produtos - Admin')

@section('content')
    <div class="content-admin">
        @component('components.admin.nav')
        @endcomponent
        <div class="content card">
            <h3 class="card-header">
                {{ $pagina }} -

                {{-- @if ($pagina == 'Produtos Principais')
                    <a class="btn btn_custom2" href="/admin/produtos">
                        {{ $pagina_filtro }}
                    </a>
                @else
                    <a class="btn btn_custom2" href="/admin/produtos_principais">
                        {{ $pagina_filtro }}
                    </a>
                @endif
                - --}}
                <a class="btn btn_custom" data-toggle="collapse" href="#openNewPost" role="button" aria-expanded="false"
                    aria-controls="openNewPost">
                    Adicionar Produtos +
                </a>
            </h3>
            <div class="collapse" id="openNewPost">
                {{-- <div> --}}
                <div class="card card-body">
                    <form action="{{ route('admin_produtos_add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nome">Nome do produto</label>
                            <input required type="text" name="nome" id="nome" class="form-control"
                                value="{{ old('nome') }}" maxlength="120" placeholder="Digite aqui o nome do produto">
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição do produto</label>
                            <textarea required="" class="form-control" placeholder="Digite aqui a descrição do produto" rows="2"
                                name="descricao" id="descricao" value="{{ old('descricao') }}">{{ old('descricao') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="modo">Modo de uso</label>
                            <textarea class="form-control" placeholder="Digite aqui o modo de uso" rows="2" name="modo"
                                value="{{ old('modo') }}" id="modo">{{ old('modo') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="medidas">Medidas</label>
                            <textarea class="form-control" placeholder="Digite aqui as medidas" rows="3" name="medidas"
                                value="{{ old('medidas') }}" id="medidas">{{ old('medidas') }}</textarea>
                        </div>
                        <div class="form-group item__column" style="display: flex">
                            <div>
                                <label for="lote">Lote</label>
                                <input required type="text" name="lote" id="lote" class="form-control"
                                    value="{{ old('lote') }}" maxlength="80">
                            </div>
                            <div style="margin:0 2rem">
                                <label for="serie">Numero de Série</label>
                                <input required type="text" name="serie" id="serie" class="form-control"
                                    value="{{ old('serie') }}" maxlength="80">
                            </div>
                            <div>
                                <label for="preco">Preço</label>
                                <input required type="text" name="preco" id="preco" class="form-control"
                                    value="{{ old('preco') }}">
                            </div>
                        </div>
                        <div class="form-group item__column" style="display: flex">
                            <div>
                                <label for="principal">Produto Principal</label>
                                <select required type="text" name="principal" id="principal" class="form-control">
                                    <option selected disabled> Escolha uma Opção</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                            <div style="margin:0 2rem">
                                <label for="ativo">Ativo no site</label>
                                <select required type="text" name="ativo" id="ativo" class="form-control">
                                    <option selected disabled> Escolha uma Opção</option>
                                    <option value="Sim">Sim</option>
                                    <option value="Não">Não</option>
                                </select>
                            </div>
                            <div>
                                <label for="estoque">Em Estoque</label>
                                <select required type="text" name="estoque" id="estoque" class="form-control">
                                    <option selected disabled> Escolha uma Opção</option>
                                    <option value="Sim">Sim</option>
                                    <option value="Não">Não</option>
                                </select>
                            </div>
                            {{-- <div style="margin:0 2rem">
                                <div>
                                    <label for="cores">
                                        Selecione um ou mais Cores
                                    </label>
                                </div>
                                <select class="select2 form-control" id="cores" name="cores[]" multiple=""
                                    tabindex="-1" style="display: none; width: 250px;">
                                    <option value="Azul">Azul</option>
                                    <option value="Rosa">Rosa</option>
                                    <option value="Branco">Branco</option>
                                    <option value="Dorado">Dorado</option>
                                    <option value="Sem cor">Sem cor</option>
                                </select>
                            </div> --}}
                        </div>
                        <div class="form-group">
                            <label for="observacao">Observação</label>
                            <textarea class="form-control"
                                placeholder="Digite aqui uma observação se desejar. Esta observação nãoi ficará visivel no site" rows="1"
                                value="{{ old('observacao') }}" name="observacao" id="observacao"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Imagem principal do produto</label>
                            <input required class="form-control py-1" type="file" accept="image/*" id="image"
                                name="image">
                        </div>
                        <div class="form-group">
                            <label for="imagem_produto">Adicionar mais Fotos do Produto</label>
                            <h6> <b>Obs:</b> Aqui voce pode escolher mais de uma foto e Gerenciala na aba Fotos Produtos
                            </h6>
                            <input multiple class="form-control py-1" type="file" accept="image/*"
                                id="imagem_produto" name="imagem_produto[]">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn_custom">Salvar Produto</button>
                            <button type="reset" class="btn btn_custom2">Limpar Dados</button>
                            <a class="btn btn-danger" data-toggle="collapse" href="#openNewPost" role="button"
                                aria-expanded="false" aria-controls="openNewPost">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="content__table">

                <div class="card-body items-produto-admin">
                    <div class="header">
                        <div class="col1">
                            <h5>Nome</h5>
                        </div>
                        <div class="col2">
                            <h5>Principal</h5>
                        </div>
                        <div class="col3">
                            <h5>Ativo</h5>
                        </div>
                        <div class="col4">
                            <h5>Foto principal</h5>
                        </div>
                        <div class="col5">
                            <h5>Ações</h5>
                        </div>
                    </div>
                    <div class="search">
                        <form action="{{ route('admin_produtos_search') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col1 form-input">
                                <small id="label1" class="form-text text-muted pl-1">
                                    Procurar pelo título da Notícia
                                </small>
                                <input type="text" name="nome" id="nome" class="form-control" maxlength="80"
                                    placeholder="Digite o nome do produto" aria-describedby="label1"
                                    @if (isset($paramsnome)) value="{{ $paramsnome }}" @endif>
                            </div>
                            <div class="col2 form-input">
                                <small id="label2" class="form-text text-muted pl-1">
                                    Procurar pela categoria
                                </small>
                                <select required type="text" name="principal" id="principal" class="form-control"
                                    aria-describedby="label2">
                                    <option selected disabled>
                                        @if (isset($paramsprincipal))
                                            {{ $paramsprincipal == 0 ? 'Não' : 'Sim' }}
                                        @else
                                            Escolha uma Opção
                                        @endif
                                    </option>
                                    <option value="">Todos</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                            <div class="col3">
                                <small id="label2" class="form-text text-muted pl-1">
                                    Procurar por ativo
                                </small>
                                <select required type="text" name="ativo" id="ativo" class="form-control"
                                    aria-describedby="label2">
                                    <option selected disabled>
                                        @if (isset($paramsativo))
                                            {{ $paramsativo == 0 ? 'Não' : 'Sim' }}
                                        @else
                                            Escolha uma Opção
                                        @endif
                                    </option>
                                    <option value="">Todos</option>
                                    <option value="Sim">Sim</option>
                                    <option value="Não">Não</option>
                                </select>
                            </div>
                            <div class="col4">
                            </div>
                            <div class="col5 actions">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="content">
                        @if (count($produtos) == 0)
                            <div class="item">
                                <h3 class="py-2 mb-0" style="text-align: center; width: 100%">Não há produtos cadastrados.
                                </h3>
                            </div>
                        @endif

                        @foreach ($produtos as $post)
                            <div class="item">
                                <div class="col1 visualizacao_produto">
                                    <p>{{ $post->nome }}</p>
                                    <p>Visualização-{{ $post->view }}</p>
                                </div>
                                <div class="col2">
                                    <p>{{ $post->principal == 0 ? 'Não' : 'Sim' }}</p>
                                </div>
                                <div class="col3">
                                    <p>{{ $post->ativo }}</p>
                                </div>
                                <div class="col4">
                                    <a href="{{ $post->image }}" target="_blanck">
                                        <img src="{{ $post->image }}" width="50">
                                    </a>
                                </div>
                                <div class="col5">
                                    <div class="actions">
                                        <a class="btn btn_custom" data-toggle="collapse"
                                            href="#collapse_foto_id_{{ $post->id }}" role="button"
                                            aria-expanded="false" aria-controls="collapse_foto_id_{{ $post->id }}">
                                            <i class="fas fa-photo"></i>
                                        </a>
                                        <a class="btn btn_custom" data-toggle="collapse"
                                            href="#collapse_id_{{ $post->id }}" role="button" aria-expanded="false"
                                            aria-controls="collapse_id_{{ $post->id }}"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin_produtos_delete') }}" method="POST"
                                            onsubmit="return confirm('Tem certeza que deseja remover este produto?')">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $post->id }}">
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="collapse" id="collapse_foto_id_{{ $post->id }}">
                                {{-- {{ $post->fotos }} --}}

                                <div class="content">
                                    @if (count($post->foto_produto) == 0)
                                        <div class="item">
                                            <h3 class="py-2 mb-0" style="text-align: center; width: 100%">Não há fotos
                                                cadastradas.</h3>
                                        </div>
                                    @endif

                                    @foreach ($post->foto_produto as $foto)
                                        <div class="item">
                                            <div class="col1 imagem_center">
                                                <a href="{{ $foto->imagem_produto }}" target="_blank">
                                                    <img class="imagem_empresa" src="{{ $foto->imagem_produto }}"
                                                        alt="Foto">
                                                </a>
                                            </div>
                                            <div class="col3" style="width: 130px">
                                                <div class="actions">
                                                    <a class="btn btn-warning" data-toggle="collapse"
                                                        href="#collapse_id_foto_individual{{ $foto->id }}"
                                                        role="button" aria-expanded="false"
                                                        aria-controls="collapse_id_foto_individual{{ $foto->id }}"><i
                                                            class="fas fa-edit"></i></a>
                                                    <form action="{{ route('admin_galeria_delete') }}" method="POST"
                                                        onsubmit="return confirm('Tem certeza que deseja remover esta Foto?')">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $foto->id }}">
                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse" id="collapse_id_foto_individual{{ $foto->id }}">
                                            <div class="card card-body">
                                                <form action="{{ route('admin_galeria_edit') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $foto->id }}">
                                                    <div class="form-group">
                                                        <label for="image">
                                                            @if ($foto->imagem_produto)
                                                                Imagem Definida. Caso queira
                                                                alterar, selecione outra foto.
                                                            @else
                                                                Adicionar Imagem do produto
                                                            @endif
                                                        </label>
                                                        <input class="form-control py-1" type="file" accept="image/*"
                                                            id="image" name="image">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success">Salvar</button>
                                                        <a class="btn btn-danger" data-toggle="collapse"
                                                            href="#collapse_id_foto_individual{{ $foto->id }}"
                                                            role="button" aria-expanded="false"
                                                            aria-controls="collapse_id_foto_individual{{ $foto->id }}">Cancelar</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="collapse" id="collapse_id_{{ $post->id }}">
                                <div class="card card-body">
                                    <form action="{{ route('admin_produtos_edit') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $post->id }}">
                                        {{-- <div class="form-group">
                                            <label for="title">Titulo do Post</label>
                                            <input required type="text" name="title" id="title"
                                                class="form-control" maxlength="80" value="{{ $post->title }}">
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="nome">Nome do produto</label>
                                            <input required type="text" name="nome" id="nome"
                                                class="form-control" value="{{ $post->nome }}" maxlength="120">
                                        </div>
                                        <div class="form-group">
                                            <label for="descricao">Descrição do produto</label>
                                            <textarea required="" class="form-control" placeholder="Digite aqui a descrição do produto" rows="2"
                                                name="descricao" id="descricao" value="{{ $post->descricao }}">{{ $post->descricao }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="modo">Modo de uso</label>
                                            <textarea class="form-control" placeholder="Digite aqui o modo de uso" rows="2" name="modo"
                                                value="{{ $post->modo }}" id="modo">{{ $post->modo }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="medidas">Medidas</label>
                                            <textarea class="form-control" placeholder="Digite aqui as medidas" rows="3" name="medidas"
                                                value="{{ $post->medidas }}" id="medidas">{{ $post->medidas }}</textarea>
                                        </div>
                                        <div class="form-group item__column" style="display: flex">
                                            <div>
                                                <label for="lote">Lote</label>
                                                <input required type="text" name="lote" id="lote"
                                                    class="form-control" value="{{ $post->lote }}" maxlength="80">
                                            </div>
                                            <div style="margin:0 2rem">
                                                <label for="serie">Numero de Série</label>
                                                <input required type="text" name="serie" id="serie"
                                                    class="form-control" value="{{ $post->serie }}" maxlength="80">
                                            </div>
                                            <div>
                                                <label for="preco">Preço</label>
                                                <input required type="text" name="preco" id="preco"
                                                    class="form-control" value="{{ $post->preco }}">
                                            </div>
                                        </div>
                                        <div class="form-group item__column" style="display: flex">
                                            <div>
                                                <label for="principal">Produto Principal</label>
                                                <select required type="text" name="principal" id="principal"
                                                    class="form-control">
                                                    <optgroup label="Selecionado anteriormente">
                                                        <option selected value="{{ $post->principal }}">
                                                            {{ $post->principal == 1 ? 'Sim' : 'Não' }}
                                                        </option>
                                                    </optgroup>
                                                    <optgroup label="Selecionar novo">
                                                        <option value="1">Sim</option>
                                                        <option value="0">Não</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div style="margin:0 2rem">
                                                <label for="ativo">Ativo no site</label>
                                                <select required type="text" name="ativo" id="ativo"
                                                    class="form-control">
                                                    <optgroup label="Selecionado anteriormente">
                                                        <option selected value="{{ $post->ativo }}">
                                                            {{ $post->ativo }}
                                                        </option>
                                                    </optgroup>
                                                    <optgroup label="Selecionar novo">
                                                        <option value="Sim">Sim</option>
                                                        <option value="Não">Não</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="estoque">Em Estoque</label>
                                                <select required type="text" name="estoque" id="estoque"
                                                    class="form-control">
                                                    <optgroup label="Selecionado anteriormente">
                                                        <option selected value="{{ $post->estoque }}">
                                                            {{ $post->estoque }}
                                                        </option>
                                                    </optgroup>
                                                    <optgroup label="Selecionar novo">
                                                        <option value="Sim">Sim</option>
                                                        <option value="Não">Não</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            {{-- <div style="margin:0 2rem">
                                                <div>
                                                    <label for="cores">
                                                        Selecione um ou mais Cores: {{ $post->cores[0] }}
                                                    </label>
                                                </div>
                                                <select class="select2 form-control" name="cores[]" multiple=""
                                                    tabindex="-1" style="display: none; width: 250px;">
                                                    <optgroup label="Selecionado anteriormente">
                                                        @foreach ($post->cores as $cores)
                                                            <option selected value="{{ $cores }}">
                                                                {{ $cores }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                    <optgroup label="Outras Categorias">
                                                        <option value="Azul">Azul</option>
                                                        <option value="Rosa">Rosa</option>
                                                        <option value="Branco">Branco</option>
                                                        <option value="Dorado">Dorado</option>
                                                        <option value="Sem cor">Sem cor</option>
                                                    </optgroup>
                                                </select>
                                            </div> --}}
                                        </div>
                                        <div class="form-group">
                                            <label for="observacao">Observação</label>
                                            <textarea class="form-control"
                                                placeholder="Digite aqui uma observação se desejar. Esta observação nãoi ficará visivel no site" rows="1"
                                                value="{{ $post->observacao }}" name="observacao" id="observacao"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="image">
                                                @if ($post->image)
                                                    <img src="{{ $post->image }}" width="250px">
                                                    Imagem principal do Produto Definida. Caso queira alterar, selecione
                                                    outra
                                                    foto.
                                                @else
                                                    Imagem principal do Produto
                                                @endif
                                            </label>
                                            <input class="form-control py-1" type="file" accept="image/*"
                                                id="image" name="image">
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="imagem_produto">Adicionar mais fotos para o produto</label>
                                            <h6> <b>Obs:</b> Aqui voce pode escolher mais de uma foto e Gerenciala na aba
                                                Fotos dos Produtos
                                            </h6>
                                            <input multiple class="form-control py-1" type="file" accept="image/*"
                                                id="imagem_produto" name="imagem_produto[]">
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn_custom">Salvar Post</button>
                                            <a class="btn btn-danger" data-toggle="collapse"
                                                href="#collapse_id_{{ $post->id }}" role="button"
                                                aria-expanded="false"
                                                aria-controls="collapse_id_{{ $post->id }}">Cancelar</a>
                                        </div>
                                    </form>

                                    <script>
                                        tinymce.init({
                                            selector: '#txt_post_id_{{ $post->id }}',
                                            language: 'pt_BR',
                                            height: 500,
                                            theme: 'silver',
                                            convert_urls: false,
                                            statusbar: false,
                                            image_title: true,
                                            automatic_uploads: true,
                                            images_upload_url: '{{ url('/admin/posts/new/tinymce_data') }}',
                                            file_picker_types: 'image',
                                            file_picker_callback: function(cb, value, meta) {

                                                var input = document.createElement('input');
                                                input.setAttribute('type', 'file');
                                                input.setAttribute('accept', 'image/*');

                                                input.onchange = function() {
                                                    var file = this.files[0];

                                                    var reader = new FileReader();
                                                    reader.readAsDataURL(file);
                                                    reader.onload = function() {
                                                        var id = 'blobid' + (new Date()).getTime();
                                                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                                                        var base64 = reader.result.split(',')[1];
                                                        var blobInfo = blobCache.create(id, file, base64);
                                                        blobCache.add(blobInfo);
                                                        cb(blobInfo.blobUri(), {
                                                            title: file.name
                                                        });
                                                    };
                                                };
                                                input.click();
                                            },
                                            plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern help',
                                            toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
                                            // image_advtab: true,
                                            // templates: [
                                            // { title: 'Test template 1', content: 'Test 1' },
                                            // { title: 'Test template 2', content: 'Test 2' }
                                            // ],
                                            // content_css: [
                                            // '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                                            // '//www.tinymce.com/css/codepen.min.css'
                                            // ]
                                        });
                                    </script>
                                </div>
                            </div>
                        @endforeach

                        @empty($produtos)
                            <div class="item p-2">
                                <h2 style="text-align: center; width: 100%" class="pl-2 mb-0 btn btn-danger">Nenhum post
                                    encontrado.
                                    </h4>
                            </div>
                        @endempty
                    </div>
                </div>

            </div>
        </div>
    </div>
    @component('components.popup_automatico')
    @endcomponent
    <script>
        tinymce.init({
            selector: '#txt',
            language: 'pt_BR',
            height: 500,
            theme: 'silver',
            convert_urls: false,
            statusbar: false,
            image_title: true,
            automatic_uploads: true,
            images_upload_url: '{{ url('/admin/posts/new/tinymce_data') }}',
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {

                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function() {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                };
                input.click();
            },
            plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern help',
            toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
            // image_advtab: true,
            // templates: [
            // { title: 'Test template 1', content: 'Test 1' },
            // { title: 'Test template 2', content: 'Test 2' }
            // ],
            // content_css: [
            // '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            // '//www.tinymce.com/css/codepen.min.css'
            // ]
        });

        $(".select2").select2();

        var expanded = false;

        function showCheckboxes() {
            var checkboxes = document.getElementById("checkboxes");
            if (!expanded) {
                checkboxes.style.display = "block";
                expanded = true;
            } else {
                checkboxes.style.display = "none";
                expanded = false;
            }
        }
    </script>

@endsection
