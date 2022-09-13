@extends('layouts.app')

@section('titlepage', 'Galeria - Admin')

@section('content')
    <div class="content-admin">
        @component('components.admin.nav')
        @endcomponent
        <div class="content card">
            {{-- <h1 class="card-header">Fotos <a class="btn btn-success" data-toggle="collapse" href="#openNewPost"
                    role="button" aria-expanded="false" aria-controls="openNewPost">Adicionar Foto +</a></h1> --}}
            {{-- <div class="collapse" id="openNewPost">
                <div class="card card-body">
                    <form action="{{ route('admin_new_gallery') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="date">Data da Imagem</label>
                            <input required type="date" name="date" id="date" class="form-control"
                                style="width: max-content">
                        </div>
                        <div class="form-group">
                            <label for="associate">Associar ao projeto</label>
                            <select class="form-control" name="associate" id="associate">
                                <option value="" selected disabled> Selecione</option>
                                @foreach ($projetos as $p)
                                    <option value="{{ $p->id }}">
                                        {{ $p->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Adicionar Imagem</label>
                            <input multiple required class="form-control py-1" type="file" accept="image/*"
                                id="image" name="image[]">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Salvar Post</button>
                            <button type="reset" class="btn btn-warning">Limpar Dados</button>
                            <a class="btn btn-danger" data-toggle="collapse" href="#openNewPost" role="button"
                                aria-expanded="false" aria-controls="openNewPost">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div> --}}
            <div class="card card-body">
                <form action="{{ route('admin_search_gallery') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <input style="width: 25vw;" type="text"name="pesquisa" placeholder="Procurar por Produto?"
                            @if (isset($paramspesquisa)) value="{{ $paramspesquisa }}" @endif>
                        <button type="submit" class="btn btn-dark">Pesquisar
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-body items-fotos-admin">
                <div class="header">
                    <div class="col1">
                        <h5>Imagem</h5>
                    </div>
                    <div class="col2">
                        <h5>Produto</h5>
                    </div>
                    <div class="col3">
                        <h5>Ações</h5>
                    </div>
                </div>

                <div class="content">
                    @if (count($fotos) == 0)
                        <div class="item">
                            <h3 class="py-2 mb-0" style="text-align: center; width: 100%">Não há fotos cadastradas.</h3>
                        </div>
                    @endif

                    @foreach ($fotos as $foto)
                        <div class="item">
                            <div class="col1">
                                <a href="{{ $foto->imagem_produto }}" target="_blank"><img src="{{ $foto->imagem_produto }}"
                                        alt="Foto"></a>
                            </div>
                            <div class="col2">
                                <p>{{ $foto->produto->nome }}</p>
                            </div>
                            <div class="col3">
                                <div class="actions">
                                    <a class="btn btn-warning" data-toggle="collapse"
                                        href="#collapse_id_{{ $foto->id }}" role="button" aria-expanded="false"
                                        aria-controls="collapse_id_{{ $foto->id }}"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin_galeria_delete') }}" method="POST"
                                        onsubmit="return confirm('Tem certeza que deseja remover esta Foto?')">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $foto->id }}">
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="collapse" id="collapse_id_{{ $foto->id }}">
                            <div class="card card-body">
                                <form action="{{ route('admin_galeria_edit') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $foto->id }}">
                                    <div class="form-group">
                                        <label for="image">
                                            @if ($foto->url)
                                                Imagem Definida. Caso queira
                                                alterar, selecione outra foto.
                                            @else
                                                Imagem de Capa
                                            @endif
                                        </label>
                                        <input class="form-control py-1" type="file" accept="image/*" id="image"
                                            name="image">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                        <a class="btn btn-danger" data-toggle="collapse"
                                            href="#collapse_id_{{ $foto->id }}" role="button" aria-expanded="false"
                                            aria-controls="collapse_id_{{ $foto->id }}">Cancelar</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @component('components.popup_automatico')
    @endcomponent

@endsection
