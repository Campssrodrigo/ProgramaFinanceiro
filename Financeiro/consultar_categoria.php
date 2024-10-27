<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::verificarLogado();
require_once '../DAO/CategoriaDAO.php';
$nome_pesquisado = '';
$dao = new CategoriaDAO();

if (isset($_POST['btnPesquisar']) || isset($_GET['filtro'])) {
    $nome_pesquisado = isset($_POST['pesquisar']) ? $_POST['pesquisar'] : $_GET['filtro'];
}
$categorias = $dao->consultarCategoria($nome_pesquisado);
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
                        <h2>Consultar Categoria</h2>
                        <h5>Consulte todas as suas categorias aqui. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <form action="consultar_categoria.php" method="post">
                            <div class="form-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Pesquise pelo nome da Categoria
                                    </div>

                                    <div class="panel-body">
                                        <div class="table-responsive">
                                                <div class="col-md-6">
                                                    <div class="form-group input-group">
                                                        <input maxlength="100" onchange="Filtro(this.value)" type="text" value="<?= $nome_pesquisado ?>" class="form-control"  name="pesquisar"  placeholder="Digite a categoria...">
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
                                Categorias cadastradas. Caso queira alterar, clicar no botão.
                            </div>

                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Nome da Categoria</th>
                                                <th>Ação</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 0; $i < count($categorias); $i++) { ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $categorias[$i]['nome_categoria'] ?></td>
                                                    <td>
                                                        <a href="alterar_categoria.php?cod=<?= $categorias[$i]['id_categoria'] ?>" class="btn btn-warning btn-sm">Alterar</a>
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
    function Filtro($nome_pesquisado) {
        window.location.href = "http://localhost/ControleFinanceiroEAD/Financeiro/consultar_categoria.php?filtro=" + $nome_pesquisado;
    }
</script>

</html>