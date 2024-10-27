<?php

class UtilDAO
{
    private static function iniciarSessao()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public static function criarSessao($cod, $nome)
    {
        self::iniciarSessao();
        $_SESSION['cod'] = $cod;
        $_SESSION['nome'] = $nome;
    }
    public static function nomeLogado(){
        self::iniciarSessao();
        return $_SESSION['nome'];
    }
    public static function codigoLogado()
    {
        self::iniciarSessao();
        return $_SESSION['cod'];
    }
    public static function Deslogar(){
        self::iniciarSessao();
        unset($_SESSION['cod']);

        header('location: login.php');
        exit;
    }
    public static function verificarLogado(){
        self::iniciarSessao();
        if(!isset($_SESSION['cod']) || $_SESSION['cod'] == ''){
            header('location: login.php');
            exit;
        }
    }
}
