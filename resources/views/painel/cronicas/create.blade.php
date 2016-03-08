@extends('painel.templates.index')

@section('content')
<div class="col-md-12">
    <div class="modal-header bg-padrao4">
        <h4 class="modal-title" id="myModalLabel">Gestão de Crônicas</h4>
    </div>

    <form class="form-padrao form-dados" method="POST" enctype="multipart/form-data" action="/painel/cronicas/adicionar-cronica" send="/painel/cronicas/adicionar-cronica" > 
        <div class="modal-body">
            <div class="alert alert-warning msg-war" role="alert" style="display: none;"></div>
            <div class="alert alert-success msg-suc" role="alert" style="display: none;"></div>

            {!! csrf_field() !!}
            <div class="form-group">
                <input type="text" name="cronica" class="form-control" placeholder="Título da Crônica" maxlength="100">
            </div>

            <div class="form-group">
                <input type="number" name="posicao"  class="form-control" placeholder="Posição">
            </div>

            <div class="form-group">
                <input type="file" name="caminho_arquivo" accept="application/pdf" >
            </div>


            <div class="form-group">
                <label ><input type="checkbox" class="form-control" name="ativo" value="1" >Ativo</label>
            </div>

            <div class="preloader" style="display: none;">Enviando os dados...</div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-lg active" onclick="limparCampos('/painel/cronicas/adicionar');" >Limpar</button>
            <button type="submit" class="btn btn-primary btn-lg active"><i class="fa fa-plus-circle"></i> Salvar</button>


        </div>
    </form>
</div>
@endsection

