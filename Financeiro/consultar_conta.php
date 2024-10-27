<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::verificarLogado();
include_once '../DAO/ContaDAO.php';
$conta_pesquisada = '';
$dao = new ContaDAO();

if (isset($_POST['btnPesquisar']) || isset($_GET['filtro'])) {
    $conta_pesquisada = isset($_POST['pesquisar']) ? $_POST['pesquisar'] : $_GET['filtro'];
}
$contas = $dao->consultarConta($conta_pesquisada);

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
                        <h2>Consultar Conta</h2>
                        <h5>Consulte todas as suas contas aqui. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <form action="consultar_conta.php" method="post">
                            <div class="form-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Pesquise pelo "Nome do Banco"
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <div class="col-md-6">
                                                <div class="form-group input-group">
                                                    <input maxlength="30" onchange="Filtro(this.value)" type="text" value="<?= $conta_pesquisada ?>" class="form-control" name="pesquisar" placeholder="Digite a categoria...">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default" name="btnPesquisar" type="button"><i class="fa fa-search"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Contas cadastradas. Caso queira alterar, clicar no botão.
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Banco</th>
                                                <th>Agência</th>
                                                <th>Número da conta</th>
                                                <th>Saldo</th>
                                                <th>Ação</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($contas as $item) { ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $item['banco_conta'] ?></td>
                                                    <td><?= $item['agencia_conta'] ?></td>
                                                    <td><?= $item['numero_conta'] ?></td>
                                                    <td>R$ <?= number_format($item['saldo_conta'], 2, ',', '.') ?></td>
                                                    <td>
                                                        <a href="alterar_conta.php?cod=<?= $item['id_conta'] ?>" class="btn btn-warning btn-sm">Alterar</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!--End Advanced Tables -->
                    </div>
                </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
        <?php 
    include_once '_rodape.php';
    ?>
    </div>
</body>
<script>
    function Filtro($conta_pesquisada) {
        window.location.href = "http://localhost/ControleFinanceiroEAD/Financeiro/consultar_conta.php?filtro=" + $conta_pesquisada;
    }
</script>

</html>