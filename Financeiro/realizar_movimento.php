<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::verificarLogado();
require_once '../DAO/MovimentoDAO.php';
require_once '../DAO/CategoriaDAO.php';
require_once '../DAO/EmpresaDAO.php';
require_once '../DAO/ContaDAO.php';

$dao_categoria = new CategoriaDAO();
$dao_empresa = new EmpresaDAO();
$dao_conta = new ContaDAO();

if (isset($_POST['btn_gravar'])) {
    $tipo = $_POST['tipo'];
    $data = $_POST['data'];
    $empresa = $_POST['empresa'];
    $valor = $_POST['valor'];
    $categoria = $_POST['categoria'];
    $conta = $_POST['conta'];
    $obs = $_POST['obs'];

    $ret = (new MovimentoDAO)->realizarMovimento($tipo, $data, $valor, $categoria, $empresa, $conta, $obs);
}

$categoria = $dao_categoria->consultarCategoria();
$empresas = $dao_empresa->consultarEmpresa();
$contas = $dao_conta->consultarConta();


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
                        <h2>Realizar movimento</h2>
                        <h5>Aqui você poderá realizar seus movimentos de entrada ou saída. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="realizar_movimento.php" method="post">
                    <div class="col-md-6">
                        <div class="form-group" id="divTipo">
                            <label>Tipo de movimento*</label>
                            <select class="form-control" name="tipo" id="tipo">
                                <option value="">Selecione</option>
                                <option value="1">Entrada</option>
                                <option value="2">Saída</option>
                            </select>
                        </div>
                        <div class="form-group" id="divData">
                            <label>Data*</label>
                            <input name="data" id="data" type="date" class="form-control" placeholder="Digite a data de movimento..." />
                        </div>
                        <div class="form-group" id="divValor">
                            <label>Valor*</label>
                            <input name="valor" id="valor" class="form-control" placeholder="Digite o valor do movimento" maxlength="10" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="divCategoria">
                            <label>Categoria*</label>
                            <select class="form-control" name="categoria" id="categoria">
                                <option value="">Selecione</option>
                                <?php foreach ($categoria as $item) { ?>
                                    <option value="<?= $item['id_categoria'] ?>">
                                        <?=$item['nome_categoria']?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group" id="divEmpresa">
                            <label>Empresa*</label>
                            <select class="form-control" name="empresa" id="empresa">
                                <option value="">Selecione</option>
                                <?php foreach ($empresas as $item) { ?>
                                    <option value="<?= $item['id_empresa'] ?>">
                                        <?=$item['nome_empresa']?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group" id="divConta">
                            <label>Conta*</label>
                            <select class="form-control" name="conta" id="conta">
                                <option value="">Selecione</option>
                                <?php foreach ($contas as $item) { ?>
                                    <option value="<?= $item['id_conta'] ?>">
                                        <?='Banco: ' . $item['banco_conta'] . ', Agência/Num: ' . $item['agencia_conta'] . '/' . $item['numero_conta'] . ' - Saldo: ' . number_format($item['saldo_conta'], 2, ',', '.')?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Observação(opcional)</label>
                            <textarea maxlength="100" class="form-control" rows="3" name="obs"></textarea>
                        </div>
                        <button name="btn_gravar" onclick="return validarMovimento()" type="submit" class="btn btn-success">Gravar</button>
                </form>
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

</html>