@extends('painel.templates.index')

@section('content')


<div class="col-md-12">

    <h1 class="titulo-pg-painel">Relatório</h1>
    <div class="divider"></div>
    <div>
        <a href="{{url('/painel')}}" class="sequenciaPaginas"></i> Home</a> \
        <span class="sequenciaPaginasAtual">Relatório</span>
    </div>


    <form class="form-padrao form-dados" method="POST" action="/painel/relatorios/gerar-relatorio" send="/painel/relatorios/gerar-relatorio" >

        <div class="modal-body">
            @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissable fade in" role="alert" >
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            {!! csrf_field() !!}

            <h4>Usuário:</h4>
            <div class="form-group">
                {!! Form::select('id_usuario', $usuarios, null) !!}
                
                <!--Form::select('size', array('L' => 'Large', 'S' => 'Small'), null, ['placeholder' => 'Pick a size...']);
            -->
                    </div>
            
            <h4>Crônica:</h4>
            <div class="form-group">
                
                {!! Form::select('id_cronica', $cronicas, null) !!}
            </div>

            <h4>Período:</h4>
            <legend></legend>
            De:
            <input type="date" name="dataInicial">
            Até
            <input type="date" name="dataFinal">


        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-lg active" onclick="limparCampos('/painel/relatorios');" ><i class="fa fa-trash-o"></i> Limpar</button>
            <button type="submit" class="btn btn-success btn-lg active"><i class="fa fa-pie-chart"></i> Gerar Relatório</button>
        </div>
    </form>

    @if(isset($total))
    <div class="conteudo-listagens">
        <div class="relatorio col-md-3">
            <i class="icone-relario fa fa-print bg-padrao2"></i> <p class="relatorio">Total de impressões: {{$total}}</p>
        </div>
    </div>
    @endif

</div>


@endsection


