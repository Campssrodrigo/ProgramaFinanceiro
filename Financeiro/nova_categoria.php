<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::verificarLogado();
require_once '../DAO/CategoriaDao.php';

if(isset($_POST['btn_gravar'])){
    $nome = $_POST['nome'];

    $ret = (new CategoriaDAO)->cadastrarCatergoria($nome);
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
                        <?php include_once '_msg.php' ?>

                        <h2>Nova Categoria</h2>
                        <h5>Aqui você poderá castrar todas as suas categorias. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_categoria.php" method="post">
                <div class="form-group" id="divNome">
                    <label>Nome da Categoria</label>
                    <input maxlength="35" name="nome" id="nomecategoria" class="form-control" placeholder="Digite o nome da categoria. Ex: Conta de luz" />
                </div>
                <button name="btn_gravar" onclick="return validarCategoria()" type="submit" class="btn btn-success">Gravar</button>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
        <?php 
    include_once '_rodape.php';
    ?>
    </div>
    </form>
</body>

</html>