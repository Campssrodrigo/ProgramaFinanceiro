<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::verificarLogado();
require_once '../DAO/EmpresaDAO.php';

$dao = new EmpresaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idEmpresa = $_GET['cod'];

    $dados = $dao->detalharEmpresa($idEmpresa);

    if (count($dados) == 0) {
        header('location: consultar_empresa.php');
        exit;
    }
    //-------------------------------------------------------------------------------------------//
} else if (isset($_POST['btn_gravar'])) {
    $idEmpresa = $_POST['cod'];
    $nomeempresa = $_POST['nomeempresa'];
    $telefoneempresa = $_POST['telefoneempresa'];
    $enderecoempresa = $_POST['enderecoempresa'];

    $ret = $dao->alterarEmpresa($idEmpresa, $nomeempresa, $telefoneempresa, $enderecoempresa);

    header('location: consultar_empresa.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btn_excluir'])) {
    $idEmpresa = $_POST['cod'];
    $ret = $dao->excluirEmpresa($idEmpresa);

    header('location: consultar_empresa.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar_empresa.php');
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

                        <h2>Alterar Empresa</h2>
                        <h5>Aqui você poderá alterar ou excluir suas empresas. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="alterar_empresa.php" method="post">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_empresa'] ?>">
                    <div class="form-group" id="divNome">
                        <label>Nome da Empresa</label>
                        <input name="nomeempresa" value="<?= $dados[0]['nome_empresa'] ?>" id="nomeempresa" class="form-control" placeholder="Digite o nome da empresa..." maxlength="50" />
                    </div>
                    <div class="form-group" id="divTelEmp">
                        <label>Telefone</label>
                        <input name="telefoneempresa" class="form-control" value="<?= $dados[0]['telefone_empresa'] ?>" placeholder="Digite o telefone da empresa...(Opcional)" maxlength="11" />
                    </div>
                    <div class="form-group" id="divEndereco">
                        <label>Endereço</label>
                        <input name="enderecoempresa" value="<?= $dados[0]['endereco_empresa'] ?>" class="form-control" placeholder="Digite o endereço da empresa...(Opcional)" maxlength="100" />
                    </div>
                    <button name="btn_gravar" onclick="return alterarEmpresaExistente()" type="submit" class="btn btn-success">Salvar</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir">Excluir</button>

                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a empresa: <b><?= $dados[0]['nome_empresa'] ?></b>
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