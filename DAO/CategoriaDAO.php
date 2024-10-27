<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';


class CategoriaDAO extends Conexao
{
    //----------------------------------Cadastrar Categoria-------------------------------------//
    public function cadastrarCatergoria($nome)
    {

        if (trim($nome) == '') {
            return 0;
        }
       
        $conexao = parent::retornaConexao();
        $comando_sql = 'insert into tb_categoria
                        (nome_categoria, id_usuario)
                         values (?, ?);';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, UtilDAO::codigoLogado());

        try {
     
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }
    //----------------------------------Alterar Categoria-------------------------------------//
    public function alterarCategoria($nome, $idCategoria)
    {

        if (trim($nome) == '' || $idCategoria == '') {
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'UPDATE tb_categoria
                        SET nome_categoria = ?
                        WHERE id_categoria = ? and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $idCategoria);
        $sql->bindValue(3, UtilDAO::codigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }
    //--------------------------------------Detalhar Categoria----------------------//
    public function detalharCategoria($idCategoria)
    {
        $conexao = parent::retornaConexao();

        $comando_sql = 'SELECT id_categoria,
                            nome_categoria
                         FROM tb_categoria
                         WHERE id_categoria = ? AND id_usuario = ?';


        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $idCategoria);
        $sql->bindValue(2, UtilDAO::codigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);


        $sql->execute();
        return $sql->fetchAll();
    }
    //---------------------------------Consultar Categoria-------------------------------------//
    public function consultarCategoria($nome_filtro = '')
    {
        $conexao = parent::retornaConexao();

        $comando_sql = 'SELECT id_categoria,
	                     nome_categoria
                        FROM tb_categoria
                        WHERE id_usuario = ? ORDER BY nome_categoria ASC';

        if ($nome_filtro != '') {
            $comando_sql = 'SELECT id_categoria,
	                     nome_categoria
                        FROM tb_categoria
                        WHERE id_usuario = ? AND nome_categoria LIKE ? ';
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
    //---------------------------------Deletar Categoria-------------------------------------//
    public function excluirCategoria($idCategoria)
    {
        if ($idCategoria == '') {
            return 0;
        }
        $conexao = parent::retornaConexao();

        $comando_sql = 'DELETE 
                        FROM tb_categoria
                        WHERE id_categoria = ? and id_usuario = ?';

        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idCategoria);
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
