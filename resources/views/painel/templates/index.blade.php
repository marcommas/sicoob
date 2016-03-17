<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{$titulo or 'Painel | Sicoob'}}</title>

        <link rel="icon" type="image/png" href="{{url('assets/img/favicon.ico')}}">

        <link rel="stylesheet" href="{{url('assets/css/bootstrap.css')}}" >

        <link href="{{url('assets/css/sb-admin-2.css') }}" rel="stylesheet">

        <link href="{{url('assets/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

        <link rel="stylesheet" type="text/css" href="{{url('assets/painel/css/genialtec.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('assets/painel/css/genialtec-responsivo.css')}}">


        <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>

    </head>
    <body >

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" style="margin-bottom: 0;  background-color: #ffffff;">
                <div class="navbar-header">
                    <h3 class="acoes-painel hidden-xs" >Seja bem-vindo {{Auth::user()->name}}!</h3>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false" aria-controls="collapseExample">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>


                </div>

                <ul class="nav navbar-top-links navbar-right hidden-xs">

                    <img src="{{url('assets/img/logo-sicoob.jpg')}}" class="logo-painel" alt="Logo Sicoob" title="Painel Sicoob">

                </ul>

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav collapse navbar-collapse">
                        <br>
                        <ul class="nav nav-color"  >
                            <li>
                                <a href="{{url('/painel/')}}" class="corNavegacao" ><i class="fa fa-home"></i> Home</a>
                            </li>    
                            <li>
                                <a href="{{url('/painel/usuarios')}} " class="corNavegacao"><i class="fa fa-users"></i> Usuários</a>
                            </li>
                            <li>
                                <a href="{{url('/painel/cronicas')}}" class="corNavegacao"><i class="fa fa-book"></i> Crônicas</a>
                            </li>
                            <li>
                                <a href="{{url('/painel/relatorios')}}" class="corNavegacao"><i class="fa fa-bar-chart"></i> Relatórios</a>
                            </li>
                            <li>
                                <a href="{{url('/painel/')}}" class="corNavegacao"><i class="fa fa-cog"></i> Configurações</a>
                            </li>
                            <li>
                                <a href="{{url('/logout')}}" class="corNavegacao"><i class="fa fa-sign-out"></i> Sair</a>
                            </li>
                        </ul>
                    </div>

                </div>

            </nav>

            <div id="page-wrapper">

                <div class="row">

                    <section class="conteudo col-md-12">
                        <div >
                            @yield('content')
                        </div>
                    </section>

                </div>



            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->



        <!-- Modal Para Deletar Conteúdo -->
        <div class="modal fade" id="modalConfirmacaoDeletar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">

                <div class="modal-content">
                    <div class="modal-header bg-padrao5">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Deletar</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="url-deletar" class="url-deletar" value=""><hidden> 
                            <div class="preloader-deletar" style="display:none;">Deletando, aguarde...</div>
                            <p>Deseja realmente deletar?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger btn-confirmar-deletar">Deletar</button>
                    </div>
                </div>
                </form
            </div>
        </div>
        <!-- Final modal de Deletar

        <!-- Latest compiled and minified JavaScript -->
        <!--<script type="text/javascript" href="{{url('assets/js/bootstrap-3.3.6.min.js')}}"></script>-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>



        @yield('scripts')

        <script>

/*
 $(function () {
 jQuery("form.form-gestao").submit(function () {
 jQuery(".msg-war").hide();
 jQuery(".msg-suc").hide();
 
 var dadosForm = jQuery(this).serialize();
 
 jQuery.ajax({
 url: jQuery(this).attr("send"),
 data: dadosForm,
 type: "POST",
 beforeSend: iniciaPreloader()
 }).done(function (data) {
 finalizaPreloader();
 
 if (data == "1") {
 jQuery(".msg-suc").html("Sucesso ao Salvar!");
 jQuery(".msg-suc").show();
 
 setTimeout("jQuery('.msg-suc').hide();jQuery('#modalGestao').modal('hide');location.reload();", 3000);
 } else {
 jQuery(".msg-war").html(data);
 jQuery(".msg-war").show();
 
 setTimeout("jQuery('.msg-war').hide();", 4500);
 }
 }).fail(function () {
 finalizaPreloader();
 alert("Falha Inesperada!");
 });
 
 return false;
 });
 });
 
 function iniciaPreloader() {
 jQuery(".preloader").show();
 }
 
 function finalizaPreloader() {
 jQuery(".preloader").hide();
 }
 
 
 function edit(url) {
 jQuery.getJSON(url, function (data) {
 jQuery.each(data, function (key, val) {
 jQuery("input[name='" + key + "']").attr("value", val);
 
 });
 });
 
 jQuery("#modalGestao").modal();
 
 jQuery("form.form-gestao").attr("send", url);
 jQuery("form.form-gestao").attr("action", url);
 
 }
 */

function del(url) {
    jQuery(".url-deletar").val(url);

    jQuery("#modalConfirmacaoDeletar").modal();
}

jQuery(".btn-confirmar-deletar").click(function () {
    var url = jQuery(".url-deletar").val();

    jQuery.ajax({
        url: url,
        type: "GET",
        beforeSend: iniciaPreloaderDeletar()
    }).done(function (data) {

        if (data == "1") {
            location.reload();
        } else {
            alert("Falha ao Deletar!");
        }

    }).fail(function () {
        alert("Falha Inesperada!");
    });
});

function iniciaPreloaderDeletar() {
    jQuery(".preloader-deletar").show();
}

function finalizaPreloaderDeletar() {
    jQuery(".preloader-deletar").hide();
}

/*jQuery("form.form-pesquisa").submit(function () {
 var textoPesquisa = jQuery(".texto-pesquisa").val();
 var url = jQuery(this).attr("send");
 
 location.href = url + textoPesquisa;
 
 return false;
 });*/


/*jQuery("form.form-pesquisa").submit(function () {
 var textoPesquisa = jQuery(".texto-pesquisa").val();
 var url = jQuery(this).attr("send");
 
 location.href = url + textoPesquisa;
 
 return false;
 });*/

/*jQuery(".btn-cadastrar").click(function(){
 jQuery("form.form-gestao").attr("send", urlAdd);
 jQuery("form.form-gestao").attr("action", urlAdd);
 
 jQuery("input[type='text']").attr("value", "");
 });*/

function limparCampos(url) {
    location.href = url;
}


        </script>

    </body>
</html>