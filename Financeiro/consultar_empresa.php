<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::verificarLogado();
include_once '../DAO/EmpresaDAO.php';
$empresa_pesquisada = '';
$dao = new EmpresaDAO();

if (isset($_POST['btnPesquisar']) || isset($_GET['filtro'])) {
    $empresa_pesquisada = isset($_POST['pesquisar']) ? $_POST['pesquisar'] : $_GET['filtro'];
}
$empresas = $dao->consultarEmpresa($empresa_pesquisada);
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
                        <h2>Consultar Empresa</h2>
                        <h5>Consulte todas as suas empresas aqui. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <form action="consultar_empresa.php" method="post">
                        <div class="form-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Pesquise pelo "Nome da Empresa"
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <div class="col-md-6">
                                                <div class="form-group input-group">
                                                    <input maxlength="100" onchange="Filtro(this.value)" type="text" value="<?= $empresa_pesquisada ?>" class="form-control" name="pesquisar"  placeholder="Digite a empresa...">
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
                                Empresas cadastradas. Caso queira alterar, clicar no botão.
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Nome da Empresa</th>
                                                <th>Telefone</th>
                                                <th>Endereço</th>
                                                <th>Ação</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($empresas as $items) { ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $items['nome_empresa'] ?></td>
                                                    <td><?= $items['telefone_empresa'] ?></td>
                                                    <td><?= $items['endereco_empresa'] ?></td>
                                                    <td>
                                                        <a href="alterar_empresa.php?cod=<?= $items['id_empresa'] ?>" class="btn btn-warning btn-sm">Alterar</a>
                                                    </td>
                                                <?php } ?>
                                                </tr>
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
    function Filtro($empresa_pesquisada) {
        window.location.href = "http://localhost/ControleFinanceiroEAD/Financeiro/consultar_empresa.php?filtro=" + $empresa_pesquisada;
    }
</script>

</html>