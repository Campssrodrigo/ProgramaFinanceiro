<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::verificarLogado();
require_once '../DAO/UsuarioDao.php';

$objdao = new UsuarioDAO();

if (isset($_POST['btn_gravar'])) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $ret = $objdao->gravarMeusDados($nome, $email, $senha);
    
}
$dados = $objdao->carregarMeusDados();

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';
?>

<body>
    <div id="wrapper">
        <?php
        include_once '_topo.php';
        include_once '_menu.php';
        ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">

                        <?php include_once '_msg.php' ?>

                        <h2>Meus Dados</h2>
                        <h5>Nesta página você poderá alterar seus dados. </h5>

                    </div>
                </div>
                <hr />
                <form action="meus_dados.php" method="post">
                    <div id="divNome">
                        <div class="form-group">
                            <label>Nome</label>
                            <input maxlength="50" name="nome" id="nome" value="<?= $dados[0]['nome_usuario'] ?>" class="form-control" placeholder="Digite seu nome aqui" />
                        </div>
                    </div>
                    <div id="divEmail">
                        <div class="form-group">
                            <label>E-mail</label>
                            <input maxlength="50" name="email" id="email" value="<?= $dados[0]['email_usuario'] ?>" class="form-control" placeholder="Digite seu e-mail aqui" />
                        </div>
                    </div>
                    <div id="divSenha">
                        <div class="form-group">
                            <label>Senha</label>
                            <input maxlength="12" name="senha" id="senha" value="<?= $dados[0]['senha_usuario'] ?>" class="form-control" placeholder="Digite sua senha aqui" />
                        </div>
                    </div>
                    <button name="btn_gravar" onclick="return validarMeusDados()" type="submit" class="btn btn-success">Gravar</button>
            </div>
          
        </div>
        <?php 
    include_once '_rodape.php';
    ?>
    </div>
    </form>
</body>

</html>