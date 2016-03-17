<!DOCTYPE html>
<html>
    <body>

    <center>
        <div style="border: 1px solid #A9A9A9; padding: 10px;">
                                           
            <h1>Olá {{$user->name}}!</h1>

            <h2>Você acabou de solicitar a troca de senha através do nosso painel de acesso.</h2>

            <h2>Clique no botão abaixo e altere sua senha urgentemente.</h2>

            <br>
            <a href=" {{ url('resetar-senha/'.$token) }}"  style="background-color: #C0C0C0 ; color: #505050; padding: 10px 18px;font-size: 18px; border: 1px solid #A9A9A9;" >Alterar senha</a>


            <br><br><br><br>

            <h4>Atenciosamente,</h4>
            <h4>Equipe Genialtec.</h4>

        </div>
    </center>
</body>
</html>