@extends('painel.templates.index')

@section('content')

<div class="col-md-12">
    
    <h1 class="titulo-pg-painel">Gestão de Crônicas</h1>
        <div class="divider"></div>
    <div>
        <a href="{{url('/painel')}}" class="sequenciaPaginas"></i> Home</a> \
        <a href="{{url('/painel/cronicas')}}" class="sequenciaPaginas"> Crônicas</a> \
        <span class="sequenciaPaginasAtual">Alteração de Crônicas</span>
    </div>
        

    <form class="form-padrao form-dados" method="POST" enctype="multipart/form-data" action="/painel/cronicas/editar/{{$cronica->id}}" send="/painel/cronicas/editar/{{$cronica->id}}" > 

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
            
            @if (session()->has('sucesso'))
                <div class="alert alert-success alert-dismissable fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    
                    <p>{{  session('sucesso') }}</p>

                </div>
            @endif

            {!! csrf_field() !!}
            <div class="form-group">
                <input type="text" name="cronica" value="{{ old('cronica', isset($cronica->cronica) ? $cronica->cronica : null)   }}" class="form-control" placeholder="Título da Crônica" maxlength="100">
            </div>
            <div class="form-group">
                <input type="number" name="posicao" value="{{ old('posicao', isset($cronica->posicao) ? $cronica->posicao : null)   }}"  class="form-control" placeholder="Posição">
            </div>
            
            @if(  ($cronica->caminho_arquivo) != "" )
            <a href="/assets/painel/upload/cronicas/{{$cronica->caminho_arquivo}}" target="_blank" class="sequenciaPaginasAtual"> 
                <label  >Visualizar Arquivo Cadastrado</label>
            </a>
            @endif
            


            <div class="form-group">
                <input type="file" name="caminho_arquivo" accept="application/pdf" >
            </div>
            <div class="form-group">

                <label >{!! Form::checkbox('ativo', '1', Input::old('ativo', $cronica->ativo), ['class' => 'form-control'] ) !!}Ativo</label>
            </div>

            <div class="preloader" style="display: none;">Enviando os dados...</div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-lg active" onclick="limparCampos('/painel/cronicas/');" ><i class="fa fa-trash-o"></i>  Limpar</button>

            <button type="submit" class="btn btn-primary btn-lg active"><i class="fa fa-floppy-o"></i> Salvar</button>


        </div>
    </form>



</div>

@endsection