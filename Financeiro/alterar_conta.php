<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::verificarLogado();
require_once '../DAO/ContaDAO.php';

$dao = new ContaDAO();
//-----------------------------Validações para não deixar usuário mudar URL----------------------//
if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idConta = $_GET['cod'];
    $dados = $dao->detalharEmpresa($idConta);

    if (count($dados) == 0) {
        header('location: consultar_conta.php');
        exit;
    }
} else if (isset($_POST['btn_gravar'])) {
    $idConta = $_POST['cod'];
    $banco = $_POST['banco'];
    $agencia = $_POST['agencia'];
    $numero = $_POST['numero'];
    $saldo = $_POST['saldo'];

    $ret = $dao->alterarConta($idConta, $banco, $agencia, $numero, $saldo);

    header('location: consultar_conta.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btn_excluir'])) {
    $idConta = $_POST['cod'];
    $ret = $dao->excluirConta($idConta);

    header('location: consultar_conta.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar_conta.php');
    exit;
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';
?>

<body>
    <div id="wrapper">

        <!-- /. NAV TOP  -->
        <!-- /. NAV SIDE  -->
        <?php
        include_once '_topo.php';
        include_once '_menu.php';
        ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '_msg.php'; ?>
                        <h2>Alterar Conta</h2>
                        <h5>Aqui você poderá alterar ou excluir suas contas. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="alterar_conta.php" method="post">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_conta'] ?>">
                    <div class="form-group" id="divNome">
                        <label>Nome da Banco*</label>
                        <input name="banco" value="<?= $dados[0]['banco_conta'] ?>" id="nomebanco" class="form-control" placeholder="Digite o nome do banco..." maxlength="20" />
                    </div>
                    <div class="form-group" id="divAgencia">
                        <label>Agência*</label>
                        <input name="agencia" value="<?= $dados[0]['agencia_conta'] ?>" id="agencia" class="form-control" placeholder="Digite o número da agência..." maxlength="8" />
                    </div>
                    <div class="form-group" id="divConta">
                        <label>Número da conta*</label>
                        <input name="numero" value="<?= $dados[0]['numero_conta'] ?>" id="numeroconta" class="form-control" placeholder="Digite o número da conta..." maxlength="12"/>
                    </div>
                    <div class="form-group" id="divSaldo">
                        <label>Saldo*</label>
                        <input name="saldo" value="<?= number_format($dados[0]['saldo_conta'],2,',','.') ?>" id="saldo" class="form-control" placeholder="Digite o saldo da conta..." maxlength="10" />
                    </div>
                    <button name="btn_gravar" onclick="return validarConta()" type="submit" class="btn btn-success">Salvar</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir">Excluir</button>

                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a conta: <b><?= $dados[0]['banco_conta'] ?> / Agência: <?= $dados[0]['agencia_conta'] ?> - Conta: <?= $dados[0]['numero_conta'] ?> </b>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" name="btn_excluir" class="btn btn-primary">Sim</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
        <?php 
    include_once '_rodape.php';
    ?>
    </div>

</body>

</html>