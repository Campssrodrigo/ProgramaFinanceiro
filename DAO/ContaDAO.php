<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class ContaDAO extends Conexao
{

    //----------------------------------Cadastrar Conta-------------------------------------//
    public function cadastrarConta($nomeBanco, $agencia, $numeroConta, $saldoConta)
    {

        if (trim($nomeBanco) == '' || trim($agencia) == '' || trim($numeroConta) == '' || trim($saldoConta) == '') {
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'INSERT INTO tb_conta
                                    (banco_conta,agencia_conta,numero_conta,saldo_conta,id_usuario)
                                    VALUES
                                    (?,?,?,?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nomeBanco);
        $sql->bindValue(2, $agencia);
        $sql->bindValue(3, $numeroConta);
        $sql->bindValue(4, $saldoConta);
        $sql->bindValue(5, UtilDAO::codigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }
    //----------------------------------Alterar Conta-------------------------------------//
    public function alterarConta($idConta, $banco, $agencia, $numero, $saldo)
    {

        if (trim($banco) == '' || trim($agencia) == '' || trim($numero) == '' || trim($saldo) == '' || $idConta == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();
        $comando_sql = 'UPDATE tb_conta
                            SET banco_conta = ?,
                                agencia_conta = ?,
                                numero_conta = ?,
                                saldo_conta = ?
                            WHERE id_conta = ? and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $banco);
        $sql->bindValue(2, $agencia);
        $sql->bindValue(3, $numero);
        $sql->bindValue(4, $saldo);
        $sql->bindValue(5, $idConta);
        $sql->bindValue(6, UtilDAO::codigoLogado());


        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    //---------------------------------Consultar Conta-------------------------------------//
    public function consultarConta($nome_filtro = '')
    {
        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT id_conta,
                        banco_conta,
                        agencia_conta,
                        numero_conta,
                        saldo_conta
                        FROM tb_conta
                        WHERE id_usuario = ? ORDER BY banco_conta ASC';
        if ($nome_filtro != '') {
            $comando_sql = 'SELECT id_conta,
                        banco_conta,
                        agencia_conta,
                        numero_conta,
                        saldo_conta
                        FROM tb_conta
                        WHERE id_usuario = ? AND banco_conta LIKE ? ORDER BY banco_conta ASC';
        }

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::codigoLogado());
        if ($nome_filtro != '') {
            $sql->bindValue(2, '%' . $nome_filtro . '%');
        }
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();
        return $sql->fetchAll();
    }
    //----------------------------------Detalhar Conta-------------------------------------//
    public function detalharEmpresa($idConta)
    {
        if ($idConta == '') {
            return 0;
        }
        $conexao = parent::retornaConexao();

        $comando_sql = 'SELECT id_conta,
                            banco_conta,
                            agencia_conta,
                            saldo_conta,
                            numero_conta
                        FROM tb_conta
                        WHERE id_conta = ? AND id_usuario = ?';


        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $idConta);
        $sql->bindValue(2, UtilDAO::codigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);


        $sql->execute();
        return $sql->fetchAll();
    }
    //----------------------------------Excluir Conta-------------------------------------//
    public function excluirConta($idConta)
    {
        if ($idConta == '') {
            return 0;
        }
        $conexao = parent::retornaConexao();

        $comando_sql = 'DELETE 
                    FROM tb_conta
                    WHERE id_conta = ? and id_usuario = ?';

        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idConta);
        $sql->bindValue(2, UtilDAO::codigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -6;
        }
    }
}
