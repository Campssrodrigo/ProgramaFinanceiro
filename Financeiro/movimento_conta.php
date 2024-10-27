<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::verificarLogado();
require_once '../DAO/MovimentoDAO.php';
require_once '../DAO/ContaDAO.php';

$data_inicial = '';
$data_final = '';
$conta = '';

$daoCat = new ContaDAO();
$consulConta = $daoCat->consultarConta();

if (isset($_POST['btnPesquisar'])) {
    $conta = $_POST['conta'];
    $data_inicial = $_POST['dataInicial'];
    $data_final = $_POST['dataFinal'];
   
    $dao = new MovimentoDAO();
    $movs = $dao->filtrarMovimentoConta($conta, $data_inicial, $data_final);
    $consulConta = $daoCat->consultarConta();
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
                        <h2>Consultar Movimentos por Contas</h2>
                        <h5>Consulta todos os movimentos em uma determinada Conta. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="movimento_conta.php" method="post">
                    <div class="form-group col-md-12" id="conta">
                        <label>Conta</label>
                        <select class="form-control" name="conta">
                            <option value="">Selecione...</option>
                            <?php foreach ($consulConta as $item) { ?>
                                <option value="<?= $item['id_conta'] ?>"><?= $item['banco_conta'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="divData">
                            <label>Data Inicial*</label>
                            <input id="data" name="dataInicial" type="date" class="form-control" placeholder="Digite a data de movimento..." value="<?= $data_inicial ?>" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="divDataFinal">
                            <label>Data Final*</label>
                            <input id="dataFinal" name="dataFinal" type="date" class="form-control" placeholder="Digite a data de movimento..." value="<?= $data_final ?>" />
                        </div>
                    </div>

                    <center>
                        <button onclick="return validarConsultaPeriodo()" id="btnPesquisar" name="btnPesquisar" class="btn btn-info">Pesquisar</button>
                    </center>
                </form>
                <hr>
                <?php if (isset($movs)) { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Resultao encontrado
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Tipo</th>
                                                    <th>Categoria</th>
                                                    <th>Empresa</th>
                                                    <th>Conta</th>
                                                    <th>Valor</th>
                                                    <th>Observação</th>
                                                    <th>Ação</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $total = 0;
                                                for ($i = 0; $i < count($movs); $i++) {
                                                    if ($movs[$i]['tipo_movimento'] == 1) {
                                                        $total = $total + $movs[$i]['valor_movimento'];
                                                    } else {
                                                        $total = $total - $movs[$i]['valor_movimento'];
                                                    }
                                                ?>
                                                    <tr class="odd gradeX">
                                                        <td><?= $movs[$i]['data_movimento'] ?></td>
                                                        <td><?= $movs[$i]['tipo_movimento'] == 1 ? 'Entrada' : 'Saída' ?></td>
                                                        <td><?= $movs[$i]['nome_categoria'] ?></td>
                                                        <td><?= $movs[$i]['nome_empresa'] ?></td>
                                                        <td><?= $movs[$i]['banco_conta'] ?> / Ag. <?= $movs[$i]['agencia_conta'] ?> - Num. <?= $movs[$i]['numero_conta'] ?></td>
                                                        <td>R$ <?= number_format($movs[$i]['valor_movimento'], 2, ',', '.') ?></td>
                                                        <td><?= $movs[$i]['obs_movimento'] ?></td>

                                                        <td>
                                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalExcluir<?= $i ?>">Excluir</a>
                                                            <form method="post" action="movimento_categoria.php">
                                                                <input type="hidden" name="idMov" value="<?= $movs[$i]['id_movimento'] ?>">
                                                                <input type="hidden" name="idConta" value="<?= $movs[$i]['id_conta'] ?>">
                                                                <input type="hidden" name="tipo" value="<?= $movs[$i]['tipo_movimento'] ?>">
                                                                <input type="hidden" name="valor" value="<?= $movs[$i]['valor_movimento'] ?>">

                                                                <div class="modal fade" id="modalExcluir<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                <h4 class="modal-title" id="myModalLabel">Confirmação de exclusão</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <center><b>Deseja excluir o movimento: </b></center>
                                                                                <br>
                                                                                <b>Data do movimento: </b> <?= $movs[$i]['data_movimento'] ?><br>
                                                                                <b>Tipo do movimento: </b> <?= $movs[$i]['tipo_movimento'] == 1 ? 'Entrada' : 'Saída' ?> <br>
                                                                                <b>Categoria: </b> <?= $movs[$i]['nome_categoria'] ?> <br>
                                                                                <b>Empresa: </b> <?= $movs[$i]['nome_empresa'] ?> <br>
                                                                                <b>Conta: </b> <?= $movs[$i]['banco_conta'] ?> / Ag. <?= $movs[$i]['agencia_conta'] ?> - Num. <?= $movs[$i]['numero_conta'] ?> <br>
                                                                                <b>Valor: </b> R$ <?= number_format($movs[$i]['valor_movimento'], 2, ',', '.') ?>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                                    <button type="submit" name="btn_excluir" class="btn btn-primary">Sim</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <center>
                                            <label style="color: <?= $total < 0 ? 'red' : 'green' ?>;">TOTAL: R$ <?= number_format($total, 2, ',', '.'); ?></label>
                                        </center>
                                    </div>

                                </div>
                            </div>
                            <!--End Advanced Tables -->
                        </div>
                    </div>
                <?php } ?>
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