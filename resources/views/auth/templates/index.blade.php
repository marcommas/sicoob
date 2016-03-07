<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>{{$titulo or 'Login | Sicoob'}}</title>
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" type="text/css" href="{{url('assets/css/bootstrap-3.3.6.min.css')}}">
        
        <!-- Optional theme -->
        <link rel="stylesheet" href="{{url('assets/css/bootstrap-theme-3.3.6.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/font-awesome-4.5.0.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('assets/painel/css/genialtec.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('assets/painel/css/genialtec-responsivo.css')}}">

        <!--JQuery-->
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

        <link rel="icon" type="image/png" href="{{url('assets/img/favicon.ico')}}">
    </head>
    <body class="bg-padrao">
        <header>
            <h1 class="oculta">{{$titulo or 'Login | Sicoob'}}</h1>
        </header>

        <section class="login">
            <div class="topo-login">
                <h1 class="titulo-login">{{$titulo or 'Login | Sicoob'}}</h1>
            </div>
            <div class="conteudo-login">
               @yield('form')
            </div>
        </section>


        <!-- Modal Recueração de Senha -->
        <div class="modal fade" id="recuperarSenha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-padrao2">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Recuperar Senha</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-padrao form-recuperar" method="POST">
                            <div class="alert alert-success success-msg" role="alert" style="display:none;"></div>
                            <div class="alert alert-danger alert-recuperar" role="alert" style="display:none;"></div>
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <input type="text" name="email" class="form-control" placeholder="E-mail">
                            </div>
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-enviar-senha">Recuperar</button>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Latest compiled and minified JavaScript -->
        <!--<script type="text/javascript" href="{{url('assets/js/bootstrap-3.3.6.min.js')}}"></script>-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        
        @yield('scripts')
        <script>
            $(function(){
                jQuery('form.form').submit(function(){
                    jQuery(".alert-danger").hide();
                    var dadosForm = jQuery(this).serialize();
                   
                    jQuery.ajax({
                       url: jQuery(this).attr("send"),
                       type: "POST",
                       data: dadosForm,
                       beforeSend: iniciaPreloader()
                    }).done(function(data){
                        finalizaPreloader();
                        if (data == "1"){
                            location.href="/painel";
                        }else{
                            jQuery(".alert-danger").show();
                            jQuery(".alert-danger").html(data);
                        }
                    }).fail(function(){
                        finalizaPreloader();
                        alert("Falha ao enviar Dados!"); 
                    });
                    
                    return false;
               });
            });

            function iniciaPreloader(){
                jQuery(".btn-enviar").attr("disabled");
            }

            function finalizaPreloader(){
                jQuery(".btn-enviar").removeAttr("disabled");
            }
            
            
            $(function(){
                jQuery('form.form-recuperar').submit(function(){
                    jQuery(".alert-recuperar").hide();
                    jQuery(".success-msg").hide();
                    
                    var dadosForm = jQuery(this).serialize();

                    jQuery.ajax({
                       url: "/recuperar-senha",
                       type: "POST",
                       data: dadosForm,
                       beforeSend: iniciaPreloaderRecuperar()
                    }).done(function(data){
                        finalizaPreloaderRecuperar();
                        if (data== "1"){
                            jQuery(".success-msg").show();
                            jQuery(".success-msg").html("Pedido de recuperação de senha enviado para o seu e-mail.");
                        }else{
                            jQuery(".alert-recuperar").show();
                            jQuery(".alert-recuperar").html(data);
                        }
                    }).fail(function(){
                        finalizaPreloaderRecuperar();
                        alert("Falha ao enviar Dados!"); 
                    });
                    
                    return false;
               });
            });

            function iniciaPreloaderRecuperar(){
                jQuery(".btn-enviar-senha").attr("disabled");
            }

            function finalizaPreloaderRecuperar(){
                jQuery(".btn-enviar-senha").removeAttr("disabled");
            }
        </script>
    </body>
</html>
