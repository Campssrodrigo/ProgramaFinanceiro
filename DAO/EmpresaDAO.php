<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class EmpresaDAO extends Conexao
{
    //----------------------------------Cadastrar Empresa-------------------------------------//
    public function cadastrarEmpresa($nome, $telefone, $endereco)
    {

        if (trim($nome) == '') {
            return 0;
        }
        $conexao = parent::retornaConexao();

       
        $comando_sql = 'INSERT INTO tb_empresa
                        (nome_empresa, telefone_empresa, endereco_empresa, id_usuario)
                        VALUES 
                        (?, ?, ?, ?);';

     
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $telefone);
        $sql->bindValue(3, $endereco);
        $sql->bindValue(4, UtilDAO::codigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
        //----------------------------------Alterar Empresa-------------------------------------//
    }
    public function alterarEmpresa($idEmpresa, $nomeEmpresa, $telefoneEmpresa, $enderecoEmpresa)
    {

        if (trim($nomeEmpresa) == '' || trim($idEmpresa) == '') {
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'UPDATE tb_empresa
                        SET nome_empresa = ?,
                            telefone_empresa = ?,
                            endereco_empresa = ?
                        WHERE id_empresa = ? and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nomeEmpresa);
        $sql->bindValue(2, $telefoneEmpresa);
        $sql->bindValue(3, $enderecoEmpresa);
        $sql->bindValue(4, $idEmpresa);
        $sql->bindValue(5, UtilDAO::codigoLogado());


        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }
    //----------------------------------Detalhar Empresa-------------------------------------//
    public function detalharEmpresa($idEmpresa)
    {

        $conexao = parent::retornaConexao();

        $comando_sql = 'SELECT id_empresa,
                            nome_empresa,
                            telefone_empresa,
                            endereco_empresa
                         FROM tb_empresa
                         WHERE id_empresa = ? AND id_usuario = ?';


        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $idEmpresa);
        $sql->bindValue(2, UtilDAO::codigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);


        $sql->execute();
        return $sql->fetchAll();
    }
    //---------------------------------Consultar Empresa-------------------------------------//
    public function consultarEmpresa($nome_filtro = '')
    {
        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT id_empresa,
                            nome_empresa,
                            telefone_empresa,
                            endereco_empresa
                    FROM tb_empresa
                    WHERE id_usuario = ? ORDER BY nome_empresa ASC';

        if ($nome_filtro != '') {
            $comando_sql = 'SELECT id_empresa,
                            nome_empresa,
                            telefone_empresa,
                            endereco_empresa
                    FROM tb_empresa
                    WHERE id_usuario = ? AND nome_empresa LIKE ? ORDER BY nome_empresa ASC';
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
    //---------------------------------Deletar Empresa-------------------------------------//
    public function excluirEmpresa($idEmpresa)
    {
        if ($idEmpresa == '') {
            return 0;
        }
        $conexao = parent::retornaConexao();

        $comando_sql = 'DELETE 
                    FROM tb_empresa
                    WHERE id_empresa = ? and id_usuario = ?';

        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idEmpresa);
        $sql->bindValue(2, UtilDAO::codigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -6;
        }
    }
}
