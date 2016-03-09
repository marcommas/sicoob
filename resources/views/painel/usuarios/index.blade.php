@extends('painel.templates.index')

@section('content')
<h1 class="titulo-pg-painel">Listagem  dos Usuários ({{$usuarios->count()}}):</h1>

<div class="divider"></div>

<div class="col-md-12">
    <div class="form-padrao form-inline padding-20">
         <a href="usuarios/adicionar" class="btn-cadastrar" ><i class="fa fa-plus-circle"></i> Novo Usuário</a>
    </div>
</div>

<table class="table table-hover">
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Cidade</th>
        <th>Estado</th>
        <th style="text-align: center;">Tipo</th>
        <th style="text-align: center;">Ativo</th>
        <th width="70px;"></th>
    </tr>
    @forelse($usuarios as $user)
    <tr>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->cidade}}</td>
        <td>{{$user->estado}}</td>
        @if ($user->tipo == 1)
            <td style="text-align: center;">Administrador</i></td>
        @elseif ($user->tipo == 2)
            <td style="text-align: center;">Comum</i></td>
        @endif
        @if ($user->ativo == 1)
            <td style="text-align: center;"><i class="fa fa-check"></i></td>
        @else
            <td></td>
        @endif
        <td>
            <a class="edit" href="usuarios/editar/{{$user->id}}">
                <i class="fa fa-pencil-square-o"></i>
            </a>
            <a class="delete" onclick="del('/painel/usuarios/deletar/{{$user->id}}')">
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
    {!! $usuarios->render() !!}
</nav>


@endsection

@section('scripts')

    <script>
        var urlAdd = '/painel/usuarios/adicionar-usuario';
    </script>

@endsection

