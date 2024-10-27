<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::verificarLogado();
require_once '../DAO/UsuarioDao.php';

$objdao = new UsuarioDAO();

if (isset($_POST['btn_gravar'])) {

    $senhaAtual = $_POST['senhaAtual'];
    $novaSenha = $_POST['novaSenha'];
    $rpNovaSenha = $_POST['rpnovaSenha'];

    $ret = $objdao->gravarMinhaSenha($senhaAtual, $novaSenha, $rpNovaSenha);
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

                        <h2>Alteração de senha</h2>
                        <h5>Nesta página você poderá alterar seu senha. </h5>

                    </div>
                </div>
                <hr />
                <form action="senha.php" method="post">
                    <input type="hidden" maxlength="12" name="senhaAtual" id="senhaAtual" value="<?= $dados[0]['senha_usuario'] ?>" class="form-control" />
                    <div id="divNovaSenha">
                        <div class="form-group">
                            <label>Nova Senha</label>
                            <input maxlength="12" name="novaSenha" id="novaSenha" class="form-control" placeholder="Digite nova senha..." />
                        </div>
                    </div>
                    <div id="divRpSenha">
                        <div class="form-group">
                            <label>Confirme Nova Senha</label>
                            <input maxlength="12" name="rpnovaSenha" id="rpnovaSenha" class="form-control" placeholder="Confirme sua nova senha..." />
                        </div>
                    </div>
                    <button name="btn_gravar" onclick="return validarMinhaSenha()" type="submit" class="btn btn-success">Gravar</button>
            </div>

        </div>
        <?php
        include_once '_rodape.php';
        ?>
    </div>
    </form>
</body>

</html>