<?php 
require_once '../DAO/UtilDAO.php';
UtilDAO::verificarLogado();
require_once '../DAO/ContaDAO.php';

if(isset($_POST['btn_gravar'])){

    $nome_banco = $_POST['nome_banco'];
    $agencia = $_POST['agencia'];
    $numero_conta = $_POST['numero_conta'];
    $saldo = $_POST['saldo'];

    $ret = (new ContaDAO)->cadastrarConta($nome_banco,$agencia,$numero_conta,$saldo); 

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
                        <?php 
                        include_once '_msg.php';
                        ?>
                        <h2>Nova Conta</h2>
                        <h5>Aqui você poderá castrar todas as suas conta. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_conta.php" method="post">
                    <div class="form-group" id="divNome">
                        <label>Nome do banco*</label>
                        <input name="nome_banco" id="nomeBanco" class="form-control" placeholder="Digite o nome do banco..." maxlength="20" />
                    </div>
                    <div class="form-group" id="divAgencia">
                        <label>Agência*</label>
                        <input name="agencia" id="agenciaConta" class="form-control" placeholder="Digite o número da agência" maxlength="8" />
                    </div>
                    <div class="form-group" id="divConta">
                        <label>Número da conta*</label>
                        <input name="numero_conta" id="numeroConta" class="form-control" placeholder="Digite o número da conta..." maxlength="12" />
                    </div>
                    <div class="form-group" id="divSaldo">
                        <label>Saldo*</label>
                        <input name="saldo" id="saldo" class="form-control" placeholder="Digite o saldo da conta"  maxlength="10"/>
                    </div>
                    <button name="btn_gravar" onclick="return validarConta()" type="submit" class="btn btn-success">Gravar</button>
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