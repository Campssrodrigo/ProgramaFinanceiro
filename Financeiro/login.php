<?php 
require_once '../DAO/UsuarioDAO.php';

if(isset($_POST['btn_acessar'])){

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $ret = (new UsuarioDAO)->validarLogin($email,$senha);
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';
?>

<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <?php include_once '_msg.php' ?>
                <h2> Controle Financeiro : Acesso</h2>
                <h5>( Faça seu login )</h5>
                <br />
            </div>
        </div>
        <div class="row ">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Entre com seus dados </strong>
                    </div>
                    <div class="panel-body">
                        <form action="login.php" method="post">
                            <br />
                            <div class="form-group input-group" id="divEmailLogin">
                                <span class="input-group-addon"><i>@</i></span>
                                <input maxlength="50" name="email" id="emailLogin" type="text" class="form-control" placeholder="Seu e-mail " />
                            </div>
                            <div class="form-group input-group" id="divSenhaLogin">
                                <span class="input-group-addon"><i id="iconeSenhaLogin" onclick="mostrarSenhaLogin()" class="fa fa-lock"></i></span>
                                <input maxlength="12" id="senhaLogin" name="senha" type="password" class="form-control" placeholder="Sua senha" />
                            </div>


                            <button name="btn_acessar" onclick="return validarLongin()" class="btn btn-primary ">Acessar</button>
                            <hr />
                            Não tem registro, <a href="cadastro.php">clique aqui! </a>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>
</body>

</html>