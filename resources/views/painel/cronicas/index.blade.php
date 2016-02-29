@extends('painel.templates.index')

@section('content')
<h1 class="titulo-pg-painel">Listagem  das Crônicas ({{$cronicas->count()}}):</h1>

<div class="divider"></div>

<div class="col-md-12">

    <form class="form-padrao form-inline padding-20 form-pesquisa" method="POST" send="/painel/cronicas/pesquisar/">
        <a href="" class="btn-cadastrar" data-toggle="modal" data-target="#modalGestao"><i class="fa fa-plus-circle"></i> Cadastrar</a>
        <input type="text" placeholder="Pesquisa" class="texto-pesquisa">
    </form>
</div>

<table class="table table-hover">
    <tr>
        <th>Crônica</th>
        <th style="text-align: center;">Posição</th>
        <th  style="text-align: center;">Ativo</th>
        <th  style="text-align: center;">Data do Cadastro</th>
        <th width="70px;"></th>
    </tr>
    @forelse($cronicas as $cronica)
    <tr>
        <td>{{$cronica->cronica}}</td>
        <td style="text-align: center;">{{$cronica->posicao}}</td>
        @if ($cronica->ativo == 1)
            <td style="text-align: center;"><i class="fa fa-check"></i></td>
        @else
            <td></td>
        @endif
        <td style="text-align: center;">{{$cronica->created_at}}</td>
        <td>
            <a class="edit" onclick="edit('/painel/cronicas/editar/{{$cronica->id}}')">
                <i class="fa fa-pencil-square-o"></i>
            </a>
            <a class="delete" onclick="del('/painel/cronicas/deletar/{{$cronica->id}}')">
                <i class="fa fa-times"></i>
            </a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="10">Nenhum registro encontrado!</td>
    </tr>

    @endforelse
</table>



<nav>
    {!! $cronicas->render() !!}
</nav>


<!-- Modal Para Gestão de Conteúdo -->
<div class="modal fade" id="modalGestao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-padrao4">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Gestão de Crônicas</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning msg-war" role="alert" style="display: none;"></div>
                <div class="alert alert-success msg-suc" role="alert" style="display: none;"></div>
                <form class="form-padrao form-gestao" action="/painel/cronicas/adicionar-cronica" send="/painel/cronicas/adicionar-cronica">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <input type="text" name="cronica" class="form-control" placeholder="Título da Crônica">
                    </div>
                    <div class="form-group">
                        <input type="text" name="posicao" class="form-control" placeholder="Posição">
                    </div>
                    <div class="form-group">
                        <input type="file"  name="caminho_arquivo" class="form-control" maxlength="500">
                    </div>
                    <div class="form-group">
                        <label ><input type="checkbox" class="form-control" name="ativo" value="1">Ativo</label>
                    </div>

                    <div class="preloader" style="display: none;">Enviando os dados...</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>

                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')

    <script>
        var urlAdd = '/painel/cronicas/adicionar-cronica';
    </script>

@endsection