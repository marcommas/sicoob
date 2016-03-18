<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Terminal | Sicoob</title>

        <link rel="icon" type="image/png" href="{{url('assets/img/favicon.ico')}}">
        
        <link rel="stylesheet" href="{{url('assets/css/bootstrap.css')}}" >

        <link rel="stylesheet" href="{{url('assets/css/bootstrap-theme.css')}}" >

        <link href="{{url('assets/terminal/css/terminal.css') }}" rel="stylesheet" type="text/css">

        <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>


        
        <script>
        
 /*2 Suissa*/
//for Chrome 
/*function PDFIframeLoad() {
    var iframe = document.getElementById('iframe_a');
   if(iframe.src) {
        var frm = iframe.contentWindow;

            frm.focus();// focus on contentWindow is needed on some ie versions  
            frm.print();
            return false;
    }
}*/
/*2 Suissa*/

        </script>
    </head>
    <body style="background-image:url({{url('assets/img/background.jpg')}});  background-position: center;  background-size: 100% 100%;">
     

        <form class="form-padrao"  method="POST" action="/terminal/home/imprimir-cronica" send="/terminal/home/imprimir-cronica" >
            {!! csrf_field() !!}
            <div class="jumbotro vertical-center">
                <input type="hidden" name="id_usuario" value="{{Auth::user()->id}}"  />

                <div class="container text-center">

                   


                    @foreach ($cronicas->all() as $cronica)
                    @if(  ($cronica->caminho_arquivo) != "" )

                    <!--<button type="submit" id="btn-imprimir"  onclick="imprimir('iframeCronica');" class="btn btn-default btn-lg active" >{{$cronica->id }} - {{$cronica->cronica }} </button>
                    -->
                    
                    <button type="submit" class="botao" onclick="imprimir('iframeCronica');" >PRESSIONE AQUI E RETIRE SUA CRÔNICA</button>
                    
                    <input type="hidden" name="id_cronica" value="{{$cronica->id}}" />
                    
                    <input type="hidden" name="posicao" value="{{$cronica->posicao}}" />

                    @endif
                    @endforeach
                    
                   <!--
                    <div id="aguardeImpressao" class="alert alert-success alert-dismissable" style="display:none;" >
                        <h1>Aguarde a sua impressão...</h1>
                    </div>
                    -->
                    
                    <!-- 3 -->
                    <iframe id='iframeCronica' src='/assets/painel/upload/cronicas/{{$cronica->caminho_arquivo}}' style="display:none;"  ></iframe>
                    <!--3-->


                </div>

            </div>

        </form>

        <!-- 2 Suissa-->
        <!--<input type="submit"  value="Print Suissa"name="Submit" id="printbtn"onclick="PDFIframeLoad()" />
          <br>
        <iframe id="iframe_a" name='iframe_a' src='/assets/painel/upload/cronicas/1457720238-teste.pdf'    width="50%"    height="50%"   ></iframe>      
        -->
        <!-- 2 Suissa-->


        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


        <script type="text/javascript">
            /*3*/
            function imprimir(id) {
                var x = document.getElementById(id);
                x.contentWindow.print();
            }
            /*3*/
            
            
            /*$(function () {
                jQuery("form.form-padrao").submit(function () {

                    jQuery(".msg-war").hide();
                    jQuery(".aguardeImpressao").hide();

                    var dadosForm = jQuery(this).serialize();

                    jQuery.ajax({
                        url: jQuery(this).attr("send"),
                        data: dadosForm,
                        type: "POST",
                        beforeSend: iniciaPreloader()
                    }).done(function (data) {
                        finalizaPreloader();

                        if (data == "1") {
                            jQuery(".msg-suc").html("Aguarde a sua impressão...");
                            jQuery(".msg-suc").show();

                            //setTimeout("jQuery('.msg-suc').hide();jQuery('#modalGestao').modal('hide');location.reload();", 5000);
                            setTimeout("jQuery('.msg-suc').hide();jQuery('#modalGestao').modal('hide');", 5000);
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
            }*/
            
            
            /*function aguardeImpressao(){

                document.getElementById("aguardeImpressao").style.display="block";
                
                setTimeout(function(){
                    document.getElementById("aguardeImpressao").style.display="none";
                },4000);
            }*/
        </script>

    </body>
</html>