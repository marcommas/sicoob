@extends('painel.templates.index')

@section('content')


<div class="conteudo-listagens">
    <div class="relatorio col-md-3">
        <i class="icone-relario fa fa-user bg-padrao2"></i> <p class="relatorio">Total de usuários: {{$usuarios}}</p>
    </div>
</div>
<div class="conteudo-listagens">
    <div class="relatorio col-md-3">
        <i class="icone-relario fa fa-book bg-padrao3"></i> <p class="relatorio">Total de crônicas: {{$cronicas}}</p>
    </div>
</div>

@endsection


