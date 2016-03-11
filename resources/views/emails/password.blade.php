<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="stylesheet" href="{{url('assets/css/bootstrap.css')}}" >
    </head>
    <body>

        <div class="well">
            <img src="{{url('assets/img/genialteclogo.jpg')}}" >

            <h2>Você acabou de solicitar a troca de senha através do nosso painel de acesso ao sistema.</h2>

            <h2>Clique no botão abaixo e altere sua senha urgentemente.</h2>

            <a href="{{ url('resetar-senha/'.$token) }}" class="btn btn-info btn-lg" >Criar nova senha</a>

            <br><br><br><br>

            <h3>Atenciosamente,</h3>
            <h3>Equipe Genialtec.</h3>

        </div>

    </body>
</html>