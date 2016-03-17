<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Terminal | Sicoob</title>

        <link rel="icon" type="image/png" href="{{url('assets/img/favicon.ico')}}">

        <link rel="stylesheet" href="{{url('assets/css/bootstrap.css')}}" >

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

        <form method="POST" action="/terminal/home/imprimir-cronica" send="/terminal/home/imprimir-cronica" >
            {!! csrf_field() !!}
            <div class="jumbotron vertical-center">
                <input type="hidden" name="id_usuario" value="{{Auth::user()->id}}"  />

                <div class="container text-center">

                    <!--<button type="submit" id="btn-imprimir" class="btn btn-default btn-lg active" >Imprimir</button>-->


                    @if (session()->has('sucesso'))
                    <br>
                    <div class="alert alert-success alert-dismissable fade in" role="alert">

                        <p>{{  session('sucesso') }}</p>

                    </div>
                    @endif


                    @foreach ($cronicas->all() as $cronica)
                    @if(  ($cronica->caminho_arquivo) != "" )

                    <button type="submit" id="btn-imprimir"  onclick="imprimir('iframeCronica');" class="btn btn-default btn-lg active" >{{$cronica->id }} - {{$cronica->cronica }} </button>

                    <input type="hidden" name="id_cronica" value="{{$cronica->id}}" />
                    <!--<a href="/assets/painel/upload/cronicas/{{$cronica->caminho_arquivo}}" target="_blank" class="sequenciaPaginasAtual"> 

                    </a>-->
                    @endif
                    @endforeach
                    
                    
                    <!-- 3 -->
                    <!--<button  onclick="imprimir('iframeCronica');" >IMPRIMIR</button>-->
                    
                    <iframe id='iframeCronica' src='/assets/painel/upload/cronicas/1457720238-teste.pdf' style="display:none;"  ></iframe>
                    <!--3-->


                </div>

            </div>

        </form>
        <!-- 1 Load And Print -->
        <!--<button id="idPrint" onclick="LoadAndPrint('/assets/painel/upload/cronicas/1457720238-teste.pdf')">Load and Print</button>
        <br>
        <div id="idContainer"></div>-->
        <!-- 1 Load And Print -->
        
        
        <!-- 2 Suissa-->
        <!--<input type="submit"  value="Print Suissa"name="Submit" id="printbtn"onclick="PDFIframeLoad()" />
          <br>
        <iframe id="iframe_a" name='iframe_a' src='/assets/painel/upload/cronicas/1457720238-teste.pdf'    width="50%"    height="50%"   ></iframe>      
        -->
        <!-- 2 Suissa-->


   



        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <script type="text/javascript">
            /*1 1 Load And Print 
             * Somente mostrando e não imprimindo*/
            /*function PrintPdf() {
                idPdf.Print();
            }

            function idPdf_onreadystatechange() {
                if (idPdf.readyState === 4)
                    setTimeout(PrintPdf, 1000);
            }

            function LoadAndPrint(url)
            {
                idContainer.innerHTML = 
                    '<object id="idPdf" onreadystatechange="idPdf_onreadystatechange()"'+
                        'width="300" height="400" type="application/pdf"' +
                        'data="' + url + '?#view=Fit&scrollbar=0&toolbar=0&navpanes=0">' +
                        '<span>PDF plugin is not available.</span>'+
                    '</object>';
            }*/
            /*1*/
        </script>

        <script type="text/javascript">
            /*3*/
            function imprimir(id) {
                var x = document.getElementById(id);
                x.contentWindow.print();
            }
            /*3*/

        </script>

    </body>
</html>