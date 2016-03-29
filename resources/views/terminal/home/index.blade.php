<!DOCTYPE html>
<html lang="pt-br">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <title>Terminal | Sicoob</title>

        <link rel="icon" type="image/png" href="{{url('assets/img/favicon.ico')}}">

        <link rel="stylesheet" href="{{url('assets/css/bootstrap.css')}}" >

        <link rel="stylesheet" href="{{url('assets/css/bootstrap-theme.css')}}" >

        <link href="{{url('assets/terminal/css/terminal.css') }}" rel="stylesheet" type="text/css">

        <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>

    </head>
    <body style="background-image:url({{url('assets/img/background.jpg')}});  background-position: center;  background-size: 100% 100%;">


        <form id="formulario" class="form-padrao"  method="POST" action="/terminal/home/imprimir-cronica" send="/terminal/home/imprimir-cronica" >
            {!! csrf_field() !!}
            <div class="jumbotro vertical-center">
                <input type="hidden" name="id_usuario" value="{{Auth::user()->id}}"  />

                <div class="container text-center">

                    @foreach ($cronicas->all() as $cronica)
                    @if(  ($cronica->caminho_arquivo) != "" )

                    <button type="button" class="botao" onclick="imprimir()" ><span class="botaoTextoSup">PRESSIONE AQUI</span><br><span class="botaoTextoInf">E RETIRE SEU TEXTO CULTURAL</span></button>

                    <input type="hidden" name="id_cronica" value="{{$cronica->id}}" />

                    <input type="hidden" name="posicao" value="{{$cronica->posicao}}" />

                    @endif
                    @endforeach
                    

                     <iframe id='iframeCronica' name='iframeCronica' src='/assets/painel/upload/cronicas/{{$cronica->caminho_arquivo}}' style="display:none;"  ></iframe>

                </div>

        </form>


        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


        <script type="text/javascript">
                              
            function imprimir() {
                document.getElementById("iframeCronica").contentWindow.print();
                
                setTimeout(
                    function(){ 
                        formulario.submit();
                }, 5000);
            }

        </script>

    </body>
</html>