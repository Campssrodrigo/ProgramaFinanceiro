
<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';


class UsuarioDAO extends Conexao
{
    //----------------------------------Buscar Meus Dados------------------------------//
    public function carregarMeusDados()
    {
        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT nome_usuario,
                                email_usuario,
                                senha_usuario
                                FROM tb_usuario 
                                WHERE id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::codigoLogado());

        //Remova index dentro do array, parmanecendo somente os as colunas BD
        $sql->setFetchMode(PDO::FETCH_ASSOC);


        $sql->execute();

        return $sql->fetchAll();
    }
    //----------------------------------Atualizar Meus Dados------------------------------//
    public function gravarMeusDados($nome, $email, $senha)
    {
        $caractaresMinimos = 3;
        $caractaresMaximos = 12;
        if (trim($nome) == '' || trim($email) == '' || trim($senha) == '') {
            return 0;
        }

        if (trim(strlen($nome)) < $caractaresMinimos) {
            return -2;
        }
        if (!$this->validandoEmail($email)) {
            return -3;
        }

        if (trim(strlen($senha)) > $caractaresMaximos) {
            return -9;
        }

        if ($this->verificarEmailDuplicadoAlteracao($email) != 0) {
            return -7;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'UPDATE tb_usuario
                        SET nome_usuario = ?,
                        email_usuario = ?,
                        senha_usuario = ?
                        WHERE id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, $senha);
        $sql->bindValue(4, UtilDAO::codigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }
    //----------------------------------Atualizar Minha Senha------------------------------//
    public function gravarMinhaSenha($senhaAtual, $novaSenha, $rpSenha)
    {
        $caractaresMinimos = 6;
        $caractaresMaximos = 12;
        if (trim($novaSenha) == '' || trim($senhaAtual) == '') {
            return 0;
        }
        if (trim(strlen($novaSenha)) > $caractaresMaximos) {
            return -9;
        }
        if (trim(strlen($novaSenha)) < $caractaresMinimos) {
            return -4;
        }
        if (trim($novaSenha) != '' && trim($novaSenha) != trim($rpSenha)) {
            return -5;
        }
        if (trim($novaSenha) == $senhaAtual) {
            return -10;
        }

        $conexao = parent::retornaConexao();
        $comando_sql = 'UPDATE tb_usuario
                            SET senha_usuario = ?
                            WHERE id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);


        $sql->bindValue(1, $novaSenha);
        $sql->bindValue(2, UtilDAO::codigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }
    //----------------------------Verifica duplicidade de Emails de usuários ----------------//
    public function verificarEmailDuplicadoAlteracao($email)
    {
        if (trim($email) == '') {
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT count(email_usuario) 
                            AS Contar FROM tb_usuario
                            WHERE email_usuario = ? AND id_usuario != ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $email);
        $sql->bindValue(2, UtilDAO::codigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        $contar = $sql->fetchAll();

        return $contar[0]['Contar'];
    }

    // -----------------------------TELA CADASTRO--------------------------------------//
    public function cadastrarMeusDados($nome, $email, $senha, $rp_senha)
    {
        $caractaresMinimos = 3;


        if (trim($nome) == '' || trim($email) == '' || trim($senha) == '' || trim($rp_senha) == '') {
            return 0;
        }
        if (trim(strlen($nome)) < $caractaresMinimos) {
            return -2;
        }
        if (!$this->validandoEmail($email)) {
            return -3;
        }
        $caractaresMinimos = 6;
        if (strlen(trim($senha)) < $caractaresMinimos) {
            return -4;
        }

        if (trim($senha) != trim($rp_senha)) {
            return -5;
        }

        if ($this->verificarEmailDuplicadoCadastro($email) != 0) {
            return -7;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'INSERT INTO tb_usuario
                        (nome_usuario, email_usuario, senha_usuario, data_cadastro)
                        VALUES
                        (?,?,?,?)';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, $senha);
        $sql->bindValue(4, date('Y-m-d'));

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function verificarEmailDuplicadoCadastro($email)
    {
        if (trim($email) == '') {
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT count(email_usuario) 
                        AS Contar FROM tb_usuario
                        WHERE email_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $email);

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        $contar = $sql->fetchAll();

        return $contar[0]['Contar'];
    }
    // -----------------------------TELA LOGIN--------------------------------------//
    public function validarLogin($email, $senha)
    {
        if (trim($email) == '' || trim($senha) == '') {
            return 0;
        }
        if (!$this->validandoEmail($email)) {
            return -3;
        }

        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT id_usuario, nome_usuario FROM tb_usuario
                        WHERE email_usuario = ? AND senha_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $email);
        $sql->bindValue(2, $senha);

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        $user = $sql->fetchAll();

        if (count($user) == 0) {
            return -8;
        }

        $cod = $user[0]['id_usuario'];
        $nome = $user[0]['nome_usuario'];
        UtilDAO::criarSessao($cod, $nome);
        header('location: inicial.php');
        exit;
    }

    private function validandoEmail($email)
    {
        $conta = "/^[a-zA-Z0-9\._-]+@";
        $domino = "[a-zA-Z0-9\._-]+.";
        $extensao = "([a-zA-Z]{2,4})$/";

        $pattern = $conta . $domino . $extensao;

        if (preg_match($pattern, $email)) {
            return true;
        } else {
            return false;
        }
    }
}
