@extends('layouts.app')

@section('titlepage', 'Produtos - Admin')

@section('content')
    <div class="content-admin">
        @component('components.admin.nav')
        @endcomponent
        <div class="content card">
            <h3 class="card-header">Produtos <a class="btn btn_custom" data-toggle="collapse" href="#openNewPost" role="button"
                    aria-expanded="false" aria-controls="openNewPost">Adicionar Produtos +</a></h3>
            {{-- <div class="collapse" id="openNewPost"> --}}
            <div>
                <div class="card card-body">
                    <form action="{{ route('admin_produtos_add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nome">Nome do produto</label>
                            <input required type="text" name="nome" id="nome" class="form-control"
                                maxlength="80">
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição do produto</label>
                            <textarea required="" class="form-control" placeholder="Digite aqui a descrição do produto" rows="2"
                                name="descricao" id="descricao"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="modo">Modo de uso</label>
                            <textarea required="" class="form-control" placeholder="Digite aqui o modo de uso" rows="2" name="modo"
                                id="modo"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="medidas">Medidas</label>
                            <textarea required="" class="form-control" placeholder="Digite aqui as medidas" rows="3" name="medidas"
                                id="medidas"></textarea>
                        </div>
                        <div class="form-group item__column" style="display: flex">
                            <div>
                                <label for="lote">Lote</label>
                                <input required type="text" name="lote" id="lote" class="form-control"
                                    maxlength="80">
                            </div>
                            <div style="margin:0 2rem">
                                <label for="serie">Numero de Série</label>
                                <input required type="text" name="serie" id="serie" class="form-control"
                                    maxlength="80">
                            </div>
                            <div style="margin:0 0rem">
                                <label for="estoque">Em Estoque</label>
                                <select required type="text" name="estoque" id="estoque" class="form-control">
                                    <option selected disabled> Escolha uma opção</option>
                                    <option value="sim">Sim</option>
                                    <option value="nao">Não</option>
                                </select>
                            </div>
                            <div style="margin:0 2rem">
                                <label for="ativo">Ativo no site</label>
                                <select required type="text" name="ativo" id="ativo" class="form-control">
                                    <option selected disabled> Escolha uma Opção</option>
                                    <option value="sim">Sim</option>
                                    <option value="nao">Não</option>
                                </select>
                            </div>
                            <div style="margin:0 2rem">
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
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="observacao">Observação</label>
                            <textarea class="form-control"
                                placeholder="Digite aqui uma observação se desejar. Esta observação nãoi ficará visivel no site" rows="1"
                                name="observacao" id="observacao"></textarea>
                        </div>
                        <div class="form-group item__column" style="display: flex">
                            <div style="margin:0 2rem 0 0rem">
                                <label for="image">Imagem principal do produto</label>
                                <input required class="form-control py-1" type="file" accept="image/*" id="image"
                                    name="image">
                            </div>
                            <div style="margin:0 ">
                                <label for="imagem_produto">Mais Imagems do produto</label>
                                <input required class="form-control py-1" type="file" accept="image/*"
                                    id="imagem_produto" name="imagem_produto">
                            </div>
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

                <div class="card-body items-post-admin">
                    <div class="header">
                        <div class="col1">
                            <h5>Nome</h5>
                        </div>
                        <div class="col2">
                            <h5>Ativo</h5>
                        </div>
                        <div class="col3">
                            <h5>Foto principal</h5>
                        </div>
                        <div class="col4">
                            <h5>Ações</h5>
                        </div>
                    </div>
                    <div class="search">
                        <form action="{{ route('admin_produtos_search') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col1 form-input">
                                <small id="label1" class="form-text text-muted pl-1">
                                    Procurar pelo título da Notícia
                                </small>
                                <input type="text" name="title" id="title" class="form-control" maxlength="80"
                                    placeholder="Digite algo sobre o título para filtrar" aria-describedby="label1"
                                    @if (isset($paramstitle)) value="{{ $paramstitle }}" @endif>
                            </div>
                            <div class="col2 form-input">
                                <small id="label2" class="form-text text-muted pl-1">
                                    Procurar pela data
                                </small>
                                <input type="date" name="date" id="date" class="form-control"
                                    aria-describedby="label2"
                                    @if (isset($paramsdate)) value="{{ $paramsdate }}" @endif>
                            </div>
                            <div class="col3 actions">
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
                                <div class="col1">
                                    <p>{{ $post->title }}</p>
                                </div>
                                <div class="col2">
                                    <p>{{ date('d-m-Y', strtotime($post->date)) }}</p>
                                </div>
                                <div class="col3">
                                    <div class="actions">
                                        <a class="btn btn_custom" data-toggle="collapse"
                                            href="#collapse_id_{{ $post->id }}" role="button" aria-expanded="false"
                                            aria-controls="collapse_id_{{ $post->id }}"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin_produtos_delete') }}" method="POST"
                                            onsubmit="return confirm('Tem certeza que deseja remover esta postagem?')">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $post->id }}">
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="collapse" id="collapse_id_{{ $post->id }}">
                                <div class="card card-body">
                                    <form action="{{ route('admin_produtos_edit') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $post->id }}">
                                        <div class="form-group">
                                            <label for="title">Titulo do Post</label>
                                            <input required type="text" name="title" id="title"
                                                class="form-control" maxlength="80" value="{{ $post->title }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Descrição Resumida</label>
                                            <input required type="text" name="description" id="description"
                                                class="form-control" maxlength="150" value="{{ $post->description }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Data do Post</label>
                                            <input required type="date" name="date" id="date"
                                                class="form-control" value="{{ $post->date }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="image">
                                                @if ($post->image)
                                                    Imagem de Capa Definida. Caso queira alterar, selecione outra foto.
                                                @else
                                                    Imagem de Capa
                                                @endif
                                            </label>
                                            <input class="form-control py-1" type="file" accept="image/*"
                                                id="image" name="image">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt">Conteúdo do Post</label>
                                            <textarea class="form-control" name="txt" id="txt_post_id_{{ $post->id }}" class="txt">{{ $post->txt }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn_custom">Salvar Post</button>
                                            <button type="reset" class="btn btn_custom2">Limpar Dados</button>
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
