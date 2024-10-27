<?php

if (isset($_GET['ret'])) {
    $ret = $_GET['ret'];
}

if (isset($ret)) {
    switch ($ret) {
        case 1:
            echo '<div class="alert alert-success">
            Ação realizada com sucesso!
            </div>';
            break;
        case 0:
            echo '<div class="alert alert-warning">
            Preencher o(s) campo(s) obrigatório(s)!
             </div>';
            break;
        case -1:
            echo '<div class="alert alert-danger">
             Ocorreu um erro na operação. Tente mais tarde.
            </div>';
            break;
        case -2:
            echo '<div class="alert alert-danger">
            O campo "NOME" não tem o mínimo de caracteres.
            </div>';
            break;
        case -3:
            echo '<div class="alert alert-danger">
            O campo "EMAIL" está com informações inválidas.
            </div>';
            break;
        case -4:
            echo '<div class="alert alert-danger">
            O campo "SENHA" deve conter no mínimo 6 caracteres.
            </div>';
            break;
        case -5:
            echo '<div class="alert alert-danger">
            O campo "SENHA" é diferente do campo "REPETIR SENHA".
            </div>';
            break;
        case -6:
            echo '<div class="alert alert-danger">
            O registro não poderá ser excluido, pois está em uso.".
            </div>';
            break;

        case -7:
            echo '<div class="alert alert-danger">
                Email já cadastrado! Use outro email.
                </div>';
            break;

        case -8:
            echo '<div class="alert alert-danger">
                    Usuário não encontrado!
                    </div>';
            break;
            
        case -9:
            echo '<div class="alert alert-danger">
                        Senha utrapassou o limite de caracteres!
                        </div>';
            break;
            case -10:
                echo '<div class="alert alert-danger">
                O "Nova Senha" deve ser diferente de "Senha Atual" .
                </div>';
                break;
    }
}
