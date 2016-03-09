<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>{{$titulo or 'Painel | Sicoob'}}</title>

        <link rel="icon" type="image/png" href="{{url('assets/img/favicon.ico')}}">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="{{url('assets/css/bootstrap-3.3.6.min.css')}}">

        <!-- Optional theme -->
        <link rel="stylesheet" href="{{url('assets/css/bootstrap-theme-3.3.6.min.css')}}">
        <!--<link rel="stylesheet" href="{{url('assets/css/font-awesome-4.5.0.min.css')}}">-->
        <!--<link rel="stylesheet" href="{{url('assets/css/font-awesome-4.3.0.min.css')}}">-->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{url('assets/painel/css/genialtec.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('assets/painel/css/genialtec-responsivo.css')}}">

        <!--JQuery-->
        <!--<script src="assets/js/jquery-1.11.3.min.js"></script>-->
        <!--<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>-->
        <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    </head>
    <body class="bg-padrao">

        <header>
            <h1 class="oculta">{{$titulo or 'Painel | Sicoob'}}</h1>
        </header>

        <section class="painel">
            <h1 class="oculta">{{$titulo or 'Painel | Sicoob'}}</h1>

            <div class="topo-painel col-md-12">
                <img src="{{url('assets/img/logo-sicoob.jpg')}}" class="logo-painel" alt="Logo Sicoob" title="Painel Sicoob">

                <h3 class="acoes-painel">Seja bem-vindo {{Auth::user()->name}}!</h3>

            </div>
            <!--End Top-->

            <div class="clear"></div>


            <div class="menu-painel col-md-2">
                <ul class="menu-painel-ul">
                    <li>
                        <a href="{{url('/painel/')}}"><i class="fa fa-home"></i> Home</a>
                    </li>    
                    <li>
                        <a href="{{url('/painel/usuarios')}}"><i class="fa fa-users"></i> Usuários</a>
                    </li>
                    <li>
                        <a href="{{url('/painel/cronicas')}}"><i class="fa fa-book"></i> Crônicas</a>
                    </li>
                    <li>
                        <a href="{{url('/painel/relatorios')}}"><i class="fa fa-bar-chart"></i> Relatórios</a>
                    </li>
                    <li>
                        <a href="{{url('/painel/')}}"><i class="fa fa-cog"></i> Configurações</a>
                    </li>
                    <li>
                        <a href="{{url('/logout')}}"><i class="fa fa-sign-out"></i> Sair</a>
                    </li>
                </ul>
            </div>
            <!--End menu-->

            <section class="conteudo col-md-10">
                <div class="cont">
                    @yield('content')
                </div>
            </section>
            <!--End Conteúdo-->
        </section>



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
        <!-- Final modal de Deletar-->

        <!-- Latest compiled and minified JavaScript -->
        <!--<script type="text/javascript" href="{{url('assets/js/bootstrap-3.3.6.min.js')}}"></script>-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

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