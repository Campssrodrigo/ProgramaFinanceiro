<?php 
require_once '../DAO/UtilDAO.php';
UtilDAO::verificarLogado();
require_once '../DAO/EmpresaDAO.php';

if(isset($_POST['btn_gravar'])){

    $nome_empresa = $_POST['nome_empresa'];
    $tel_empresa = $_POST['tel_empresa'];
    $endereco_empresa = $_POST['endereco_empresa'];

    $ret = (new EmpresaDAO)->CadastrarEmpresa($nome_empresa, $tel_empresa, $endereco_empresa);
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
                        <h2>Nova empresa</h2>
                        <h5>Aqui você poderá castrar todas as suas empresas. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_empresa.php" method="post">
                <div class="form-group" id="divNome">
                    <label>Nome da Empresa*</label>
                    <input name="nome_empresa" id="nomeempresa" class="form-control" placeholder="Digite o nome da empresa..." maxlength="50" />
                </div>
                <div class="form-group" id="divTelEmp">
                    <label>Telefone</label>
                    <input id="telempresa" name="tel_empresa" class="form-control" placeholder="Digite o telefone da empresa...(Opcional)" maxlength="11" />
                </div>
                <div class="form-group" id="divEndereco">
                    <label>Endereço</label>
                    <input id="enderecoempresa" name="endereco_empresa" class="form-control" placeholder="Digite o endereço da empresa...(Opcional)" maxlength="100" />
                </div>
                <button name="btn_gravar" onclick="return validarEmpresa()" type="submit" class="btn btn-success">Gravar</button>
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