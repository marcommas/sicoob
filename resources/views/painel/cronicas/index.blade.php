@extends('painel.templates.index')

@section('content')

<h1 class="titulo-pg-painel">Listagem  das Crônicas ({{$cronicas->count()}}):</h1>

<div class="divider"></div>

<div class="col-md-12">
    <div class="form-padrao form-inline padding-20">
        <a href="cronicas/adicionar" class="btn-cadastrar" ><i class="fa fa-plus-circle"></i> Nova Crônica</a>
    </div>
    
    
    <!--<form class="form-padrao form-inline padding-20" method="POST" action="/painel/cronicas/"  send="/painel/cronicas/">
        {!! csrf_field() !!}
        
        <input type="text" name="pesquisar" placeholder="Pesquisa" class="texto-pesquisa">
    </form>-->
</div>

<table class="table table-hover">
    <tr>
        <th>Crônica</th>
        <th style="text-align: center;">Visualizar Crônica</th>
        <th style="text-align: center;">Posição</th>
        <th style="text-align: center;">Ativo</th>
        <th style="text-align: center;">Data do Cadastro</th>
        <th width="70px;"></th>
    </tr>
    @forelse($cronicas as $cronica)
    <tr>
        <td>{{$cronica->cronica}}</td>
        
        <td style="text-align: center;" >
        @if(  ($cronica->caminho_arquivo) != "" )
            <a href="/assets/painel/upload/cronicas/{{$cronica->caminho_arquivo}}" target="_blank" style="color: #000000;" ><i class="fa fa-file-pdf-o"></i></a>
        @endif
        </td>
        <td style="text-align: center;">{{$cronica->posicao}}</td>
        @if ($cronica->ativo == 1)
        <td style="text-align: center;"><i class="fa fa-check"></i></td>
        @else
        <td></td>
        @endif
        <td style="text-align: center;">{{$cronica->created_at}}</td>
        <td>
            <a class="edit" href="cronicas/editar/{{$cronica->id}}">
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


<nav >
    {!! $cronicas->render() !!}
</nav>



@endsection

