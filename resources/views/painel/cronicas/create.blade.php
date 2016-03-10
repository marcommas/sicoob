@extends('painel.templates.index')

@section('content')
<div class="col-md-12">
    <div>
        <a href="{{url('/painel')}}"></i> Home</a> >
        <a href="{{url('/painel/cronicas')}}"> Crônicas</a> 
        > <span style="font-weight: bold; color: #4C7C83;">Cadastro de Crônicas</span>
    </div>
    
    <div class="modal-header bg-padrao4">
        <h4 class="modal-title" id="myModalLabel">Gestão de Crônicas</h4>
    </div>

    <form class="form-padrao form-dados" method="POST" enctype="multipart/form-data" action="/painel/cronicas/adicionar-cronica" send="/painel/cronicas/adicionar-cronica" > 
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
                <input type="text" name="cronica" value="{{ old('cronica', isset($cronica->cronica) ? $cronica->cronica : null)   }}" class="form-control" placeholder="Título da Crônica*" maxlength="100">
            </div>

            <div class="form-group">
                <input type="number" name="posicao" value="{{ old('posicao', isset($cronica->posicao) ? $cronica->posicao : null)   }}"  class="form-control" placeholder="Posição*">
            </div>
            <div class="  bg-warning">
                <blockquote>

                    <p >O nome do seu <strong>arquivo não deve conter espaço</strong>. Utiliza-se _ (underline) ao invés do espaço.</p>
                    <p >Ex: <strong>nome_do_arquivo.pdf</strong></p>
                    <p >O arquivo deve conter um <strong>tamanho máximo de 5 Mb</strong>.</p>

                </blockquote>
            </div>

            <div class="form-group">
                <label >Caminho do Arquivo*</label>
                <input type="file" name="caminho_arquivo" accept="application/pdf" >
            </div>


            <div class="form-group">
                <label ><input type="checkbox" class="form-control" name="ativo" value="1" >Ativo</label>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-lg active" onclick="limparCampos('/painel/cronicas/adicionar');" ><i class="fa fa-trash-o"></i> Limpar</button>
            <button type="submit" class="btn btn-primary btn-lg active"><i class="fa fa-floppy-o"></i> Salvar</button>


        </div>
    </form>
</div>


@endsection

