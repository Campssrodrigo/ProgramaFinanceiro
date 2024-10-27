<?php
require_once '../DAO/UsuarioDAO.php';

if (isset($_POST['btn_finalizar'])) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $rp_senha = $_POST['rp_senha'];

    $ret = (new UsuarioDAO)->cadastrarMeusDados($nome, $email, $senha, $rp_senha);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';

?>

<body>
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <h2> Cotrole Financeiro : Cadastro</h2>

                <h5>( Faça seu cadastro )</h5>
                <?php
                include_once '_msg.php'
                ?>
                <br />
            </div>
        </div>
        <div class="row">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Preencher todos os campos! </strong>
                    </div>

                    <div class="panel-body">
                        <form action="cadastro.php" method="post">
                            <br />

                            <div id="divNome">
                                <div class="form-group input-group">
                                    <span class="input-group-addon">O<i class="fa fa-circle-o-notch"></i></span>
                                    <input maxlength="50" id="nome" name="nome" type="text" class="form-control" placeholder="Seu nome" value="<?= isset($nome) ? $nome : '' ?>" />
                                </div>
                            </div>

                            <div id="divEmail">
                                <div class="form-group input-group">
                                    <span class="input-group-addon">@</span>
                                    <input maxlength="50" id="email" name="email" type="text" class="form-control" placeholder="Seu E-mail" value="<?= isset($email) ? $email : '' ?>" />
                                </div>
                            </div>

                            <div id="divSenha">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i id="iconeSenha" onclick="mostrarSenhaCadastro()" class="fa fa-lock"></i></span>
                                    <input maxlength="12" id="senha" name="senha" type="password" class="form-control" placeholder="Crie uma senha(mínimo 6 caracteres)" />
                                </div>
                            </div>

                            <div id="divRSenha">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i id="iconeRpsenha" onclick="mostrarRpSenhaCadastro()" class="fa fa-lock"></i></span>
                                    <input maxlength="12" id="rpsenha" name="rp_senha" type="password" class="form-control" placeholder="Repita a senha digitada" />
                                </div>
                            </div>

                            <button onclick="return validarCadastro()" name="btn_finalizar" class="btn btn-success ">Finalizar cadastro</button>
                            <hr />
                            Já possui cadastro ? <a href="login.php">Clique aqui!</a>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>
</body>

</html>