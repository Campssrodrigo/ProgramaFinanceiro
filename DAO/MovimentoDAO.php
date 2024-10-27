<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class MovimentoDAO extends Conexao
{

    //-------------------------------------------------REALIZAR MOVIMENTO-----------------------------//
    public function realizarMovimento($tipo_mov, $data, $valor, $categoria, $empresa, $conta, $obs)
    {

        if ($tipo_mov == '' || trim($data) == '' || trim($valor) == '' || $categoria == '' || $empresa == '' || $conta == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();

        $comando_sql = 'INSERT INTO tb_movimento
        (tipo_movimento, data_movimento, valor_movimento,
        obs_movimento,id_empresa, id_conta, id_categoria, id_usuario)
        VALUES
        (?,?,?,?,?,?,?,?)';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $tipo_mov);
        $sql->bindValue(2, $data);
        $sql->bindValue(3, $valor);
        $sql->bindValue(4, $obs);
        $sql->bindValue(5, $empresa);
        $sql->bindValue(6, $conta);
        $sql->bindValue(7, $categoria);
        $sql->bindValue(8, UtilDAO::codigoLogado());

        $conexao->beginTransaction();

        try {
            $sql->execute();

            switch ($tipo_mov) {
                case 1:
                    $comando_sql = 'UPDATE tb_conta SET saldo_conta = saldo_conta + ? 
                                    WHERE id_conta = ?  ';
                    break;
                case 2:
                    $comando_sql = 'UPDATE tb_conta SET saldo_conta = saldo_conta - ? 
                                    WHERE id_conta = ?  ';
                    break;
            }
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $valor);
            $sql->bindValue(2, $conta);

            $sql->execute();
            $conexao->commit();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $conexao->rollBack();
            return -1;
        }
    }

    //---------------------------------CONSULTAR MOVIMENTO------------------------------------------//

    public function filtrarMovimento($tipo, $data_inicial, $data_final)
    {

        if (trim($data_inicial) == '' || trim($data_final) == '') {
            return 0;
        }
        $conexao = parent::retornaConexao();

        $comando_sql = 'SELECT id_movimento, 
                        tb_movimento.id_conta,
                        tipo_movimento,
		                DATE_FORMAT(data_movimento, "%d/%m/%Y") AS data_movimento,
                        valor_movimento,
                        nome_categoria,
                        obs_movimento,
                        nome_empresa,
                        banco_conta,
                        numero_conta,
                        agencia_conta
                        FROM	tb_movimento
                        INNER JOIN tb_categoria
                        ON 		tb_categoria.id_categoria = tb_movimento.id_categoria
                        INNER JOIN tb_empresa
                        ON		tb_empresa.id_empresa = tb_movimento.id_empresa
                        INNER JOIN tb_conta
                        ON		tb_conta.id_conta = tb_movimento.id_conta
                        WHERE tb_movimento.id_usuario = ?
                        AND tb_movimento.data_movimento BETWEEN ? AND ?';

        if ($tipo != 0) {
            $comando_sql = $comando_sql . 'AND tipo_movimento = ?';
        }

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::codigoLogado());
        $sql->bindValue(2, $data_inicial);
        $sql->bindValue(3, $data_final);
        if ($tipo != 0) {
            $sql->bindValue(4, $tipo);
        }

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    //-------------------------------Excluir Movimento---------------------------------//

    public function excluirMovimento($idMovimento, $idConta, $valor, $tipo)
    {
        if ($idMovimento == '' || $idConta == '' || $valor == '' || $tipo == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();

        $comando_sql = 'DELETE FROM tb_movimento
                        WHERE id_movimento = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idMovimento);

        $conexao->beginTransaction();

        try {
            $sql->execute();
            if ($tipo == 1) {
                $comando_sql = 'UPDATE tb_conta 
                    SET saldo_conta = saldo_conta - ?
                    WHERE id_conta = ?';
            } elseif ($tipo == 2) {
                $comando_sql = 'UPDATE tb_conta
                    SET saldo_conta = saldo_conta + ?
                    WHERE id_conta = ?';
            }
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $valor);
            $sql->bindValue(2, $idConta);
            $sql->execute();
            $conexao->commit();
            return 1;
        } catch (Exception $ex) {
            $conexao->rollBack();
            echo $ex->getMessage();
            return -1;
        }
    }

    //-----------------------------------Filtrar Categoria Mov----------------------------------------//

    public function filtrarMovimentoCategoria($idCategoria, $data_inicial, $data_final)
    {

        if (trim($data_inicial) == '' || trim($data_final) == '') {
            return 0;
        }
        $conexao = parent::retornaConexao();

        $comando_sql = 'SELECT id_movimento, 
                        tb_movimento.id_conta,
                        tipo_movimento,
		                DATE_FORMAT(data_movimento, "%d/%m/%Y") AS data_movimento,
                        valor_movimento,
                        nome_categoria,
                        obs_movimento,
                        nome_empresa,
                        banco_conta,
                        numero_conta,
                        agencia_conta
                        FROM	tb_movimento
                        INNER JOIN tb_categoria
                        ON 		tb_categoria.id_categoria = tb_movimento.id_categoria
                        INNER JOIN tb_empresa
                        ON		tb_empresa.id_empresa = tb_movimento.id_empresa
                        INNER JOIN tb_conta
                        ON		tb_conta.id_conta = tb_movimento.id_conta
                        WHERE tb_movimento.id_usuario = ?
                        AND tb_movimento.data_movimento BETWEEN ? AND ?';

        if ($idCategoria != '') {
            $comando_sql = $comando_sql . 'AND tb_movimento.id_categoria = ?';
        }

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::codigoLogado());
        $sql->bindValue(2, $data_inicial);
        $sql->bindValue(3, $data_final);
        if ($idCategoria != '') {
            $sql->bindValue(4, $idCategoria);
        }

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

  //-----------------------------------Filtrar Empresa Mov----------------------------------------//

  public function filtrarMovimentoEmpresa($idEmpresa, $data_inicial, $data_final)
  {

      if (trim($data_inicial) == '' || trim($data_final) == '') {
          return 0;
      }
      $conexao = parent::retornaConexao();

      $comando_sql = 'SELECT id_movimento, 
                      tb_movimento.id_conta,
                      tipo_movimento,
                      DATE_FORMAT(data_movimento, "%d/%m/%Y") AS data_movimento,
                      valor_movimento,
                      nome_categoria,
                      obs_movimento,
                      nome_empresa,
                      banco_conta,
                      numero_conta,
                      agencia_conta
                      FROM	tb_movimento
                      INNER JOIN tb_categoria
                      ON 		tb_categoria.id_categoria = tb_movimento.id_categoria
                      INNER JOIN tb_empresa
                      ON		tb_empresa.id_empresa = tb_movimento.id_empresa
                      INNER JOIN tb_conta
                      ON		tb_conta.id_conta = tb_movimento.id_conta
                      WHERE tb_movimento.id_usuario = ?
                      AND tb_movimento.data_movimento BETWEEN ? AND ?';

      if ($idEmpresa != '') {
          $comando_sql = $comando_sql . 'AND tb_movimento.id_empresa = ?';
      }

      $sql = new PDOStatement();
      $sql = $conexao->prepare($comando_sql);

      $sql->bindValue(1, UtilDAO::codigoLogado());
      $sql->bindValue(2, $data_inicial);
      $sql->bindValue(3, $data_final);
      if ($idEmpresa != '') {
          $sql->bindValue(4, $idEmpresa);
      }

      $sql->setFetchMode(PDO::FETCH_ASSOC);
      $sql->execute();
      return $sql->fetchAll();
  }

 //-----------------------------------Filtrar Conta Mov----------------------------------------//

 public function filtrarMovimentoConta($idConta, $data_inicial, $data_final)
 {

     if (trim($data_inicial) == '' || trim($data_final) == '') {
         return 0;
     }
     $conexao = parent::retornaConexao();

     $comando_sql = 'SELECT id_movimento, 
                     tb_movimento.id_conta,
                     tipo_movimento,
                     DATE_FORMAT(data_movimento, "%d/%m/%Y") AS data_movimento,
                     valor_movimento,
                     nome_categoria,
                     obs_movimento,
                     nome_empresa,
                     banco_conta,
                     numero_conta,
                     agencia_conta
                     FROM	tb_movimento
                     INNER JOIN tb_categoria
                     ON 		tb_categoria.id_categoria = tb_movimento.id_categoria
                     INNER JOIN tb_empresa
                     ON		tb_empresa.id_empresa = tb_movimento.id_empresa
                     INNER JOIN tb_conta
                     ON		tb_conta.id_conta = tb_movimento.id_conta
                     WHERE tb_movimento.id_usuario = ?
                     AND tb_movimento.data_movimento BETWEEN ? AND ?';

     if ($idConta != '') {
         $comando_sql = $comando_sql . 'AND tb_movimento.id_conta = ?';
     }

     $sql = new PDOStatement();
     $sql = $conexao->prepare($comando_sql);

     $sql->bindValue(1, UtilDAO::codigoLogado());
     $sql->bindValue(2, $data_inicial);
     $sql->bindValue(3, $data_final);
     if ($idConta != '') {
         $sql->bindValue(4, $idConta);
     }

     $sql->setFetchMode(PDO::FETCH_ASSOC);
     $sql->execute();
     return $sql->fetchAll();
 }

    //--------------------Totalizando entradas e saídas para iniciar--------------------------//

    public function totalEntrada(){
        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT SUM(valor_movimento) AS total
                        FROM tb_movimento
                        WHERE tipo_movimento = 1
                        AND id_usuario = ?;';

       $sql = new PDOStatement(); 
       $sql = $conexao->prepare($comando_sql);
       $sql->bindValue(1, UtilDAO::codigoLogado());
       $sql->setFetchMode(PDO::FETCH_ASSOC);

       $sql->execute();

       return $sql->fetchAll();
    }
    
    public function totalSaida(){
        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT SUM(valor_movimento) AS total
                        FROM tb_movimento
                        WHERE tipo_movimento = 2
                        AND id_usuario = ?;';

       $sql = new PDOStatement(); 
       $sql = $conexao->prepare($comando_sql);
       $sql->bindValue(1, UtilDAO::codigoLogado());
       $sql->setFetchMode(PDO::FETCH_ASSOC);

       $sql->execute();

       return $sql->fetchAll();
    }
//---------------------------Demonstrar movimento tela inicial-----------------//
    public function mostrarUltimosMovimentos()
    {

        
        $conexao = parent::retornaConexao();

        $comando_sql = 'SELECT id_movimento, 
                        tb_movimento.id_conta,
                        tipo_movimento,
		                DATE_FORMAT(data_movimento, "%d/%m/%Y") AS data_movimento,
                        valor_movimento,
                        nome_categoria,
                        obs_movimento,
                        nome_empresa,
                        banco_conta,
                        numero_conta,
                        agencia_conta
                        FROM	tb_movimento
                        INNER JOIN tb_categoria
                        ON 		tb_categoria.id_categoria = tb_movimento.id_categoria
                        INNER JOIN tb_empresa
                        ON		tb_empresa.id_empresa = tb_movimento.id_empresa
                        INNER JOIN tb_conta
                        ON		tb_conta.id_conta = tb_movimento.id_conta
                        WHERE tb_movimento.id_usuario = ?
                        ORDER BY tb_movimento.id_movimento DESC LIMIT 10';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::codigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }
}
