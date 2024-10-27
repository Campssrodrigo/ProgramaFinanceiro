function validarMeusDados() {
    var ret = true;
    campos = "";

    if ($("#nome").val().trim() == '') {
        $("#divNome").addClass("has-error");
        ret = false;
        campos += "- Nome \n";
    } else {
        $("#divNome").removeClass("has-error").addClass("has-success");

    }
    if ($("#email").val().trim() == '') {
        $("#divEmail").addClass("has-error");
        ret = false;
        campos += "- E-mail \n";
    } else {
        $("#divEmail").removeClass("has-error").addClass("has-success");
    }
    if ($("#senha").val().trim() == '') {
        $("#divSenha").addClass("has-error");
        ret = false;
        campos += "- Senha \n";
    } else {
        $("#divSenha").removeClass("has-error").addClass("has-success");
    }
    if (!ret) {
        alert("Preencher os campos: \n" + campos);
    }
    return ret;
}

//---------------------VALIDANDO Minha Senha-------------------------------------------------------//
function validarMinhaSenha() {
    var ret = true;
    campos = "";

    if ($("#novaSenha").val().trim() == '') {
        $("#divNovaSenha").addClass("has-error");
        ret = false;
        campos += "- Nova Senha \n";
    } else if ($("#novaSenha").val().trim().length < 6) {
        $("#divNovaSenha").addClass("has-error");
        ret = false;
        campos += "- Nova senha está prenchido incorretamente \n";
    } else if($("#novaSenha").val().trim() != '' && $("#novaSenha").val().trim() != $("#rpsenha").val().trim()) {
        $("#divNovaSenha").addClass("has-error");
        ret = false;
        campos += "- Nova Senha é diferente de Repetir Senha \n";
    }else{
        $("#divNovaSenha").removeClass("has-error").addClass("has-success");
    }

    if ($("#novaSenha").val().trim().length >= 6 && $("#rpsenha").val().trim() == '' ) {
        $("#divRpSenha").addClass("has-error");
        ret = false
        campos += "- Repetir senha \n";
    }else if($("#novaSenha").val().trim() == $("#senhaAtual").val().trim()) {
        $("#divNovaSenha").addClass("has-error");
        ret = false;
        campos += "- Nova senha é igual a senha atual \n";
    } 
    else if ($("#novaSenha").val().trim().length >= 6 && $("#rpnovaSenha").val().trim() != $("#novaSenha").val().trim()) {
        $("#divRpSenha").addClass("has-error");
        ret = false;
        campos += "- Repetir Senha está com informações inválidas";
    } else if($("#rpnovaSenha").val().trim() == $("#novaSenha").val().trim() && $("#novaSenha").val().trim() != ''){
        $("#divRpSenha").removeClass("has-error").addClass("has-success");
    }
    if (!ret) {
        alert("Preencher os campos: \n" + campos);
    }
    return ret;
}
//---------------------VALIDANDO CATEGORIA-------------------------------------------------------//
function validarCategoria() {
    var ret = true;
    campos = '';
    if ($("#nomecategoria").val().trim() == '') {
        $("#divNome").addClass("has-error");
        campos += "- Nome da categoria";
        ret = false;
    } else {
        $("#divNome").removeClass("has-error").addClass("has-success");
    }
    if (!ret) {
        alert("Preencher os campos: \n " + campos);
    }
    return ret;
}

function alterarCategoriaExistente() {
    var ret = true;
    campos = '';
    if ($("#nomecategoria").val().trim() == '') {
        $("#divNome").addClass("has-error");
        campos += "- Nome da categoria";
        ret = false;
    }
    if (!ret) {
        alert("Preencher os campos: \n" + campos);
    } 
    return ret;

}
//----------------------VALIDANDO EMPRESA--------------------------------------------------//
function validarEmpresa() {
    var ret = true;
    campos = '';
    if ($("#nomeempresa").val().trim() == '') {
        $("#divNome").addClass("has-error");
        $("#divTelEmp").addClass("has-warning");
        $("#divEndereco").addClass("has-warning");
        campos += "\n - Nome da empresa";
        ret = false;
    } else {
        $("#divNome").removeClass("has-error").addClass("has-success");
    }
    if (!ret) {
        alert("Preencher os campos: \n" + campos);
    } 
    return ret;
}

function alterarEmpresaExistente() {
    var ret = true;
    campos = '';
    if ($("#nomeempresa").val().trim() == '') {
        $("#divNome").addClass("has-error");
        $("#divTelEmp").addClass("has-warning");
        $("#divEndereco").addClass("has-warning");
        campos += "\n - Nome da empresa";
        ret = false;
    }

    if (!ret) {
        alert("Preencher os campos: \n" + campos);
    } 
    return ret;

}
//----------------------VALIDANDO CONTA----------------------------------------------------//
function validarConta() {
    var ret = true;
    campos = "";
    if ($("#nomeBanco").val().trim() == '') {
        $("#divNome").addClass("has-error");
        campos += "- Nome Banco \n";
        ret = false;
    } else {
        $("#divNome").removeClass("has-error").addClass("has-success");
    }

    if ($("#agenciaConta").val().trim() == '') {
        $("#divAgencia").addClass("has-error");
        campos += "- Agencia \n";
        ret = false;
    }else if(isNaN($("#agenciaConta").val().trim())){
        $("#divAgencia").addClass("has-error");
        campos += "- Campo Agência com informações inválidas \n";
        ret = false;
    } else {
        $("#divAgencia").removeClass("has-error").addClass("has-success");
    }

    if ($("#numeroConta").val().trim() == '') {
        $("#divConta").addClass("has-error");
        campos += "- Número da conta \n";
        ret = false;
    }else if(isNaN($("#numeroConta").val().trim())){
        $("#divConta").addClass("has-error");
        campos += "- Campo Número da conta com informações inválidas \n";
        ret = false;
    } else {
        $("#divConta").removeClass("has-error").addClass("has-success");
    }

    if ($("#saldo").val().trim() == '') {
        $("#divSaldo").addClass("has-error");
        campos += "- Saldo \n";
        ret = false;
    } else if(isNaN($("#saldo").val().trim())){
        $("#divSaldo").addClass("has-error");
        campos += "- Campo saldo com informações inválidas \n";
        ret = false;
    } else {
        $("#divSaldo").removeClass("has-error").addClass("has-success");
    }

    if (!ret) {
        alert("Preencher os campos: \n" + campos);
    } 
    return ret;
}
//----------------------VALIDANDO MOVIMENTO----------------------------------------------------------//
function validarMovimento() {
    var ret = true;
    campos = "";
    if ($("#tipo").val() == '') {
        $("#divTipo").addClass("has-error");
        campos += "- Tipo de movimento \n";
        ret = false;
    } else {
        $("#divTipo").removeClass("has-error").addClass("has-success");
    }

    if ($("#data").val().trim() == '') {
        $("#divData").addClass("has-error");
        campos += "- Data \n";
        ret = false;
    } else {
        $("#divData").removeClass("has-error").addClass("has-success");
    }

    if ($("#valor").val().trim() == '') {
        $("#divValor").addClass("has-error");
        campos += "- Valor \n";
        ret = false;
    } else if(isNaN($("#valor").val().trim())){
        $("#divValor").addClass("has-error");
        campos += "- Campo valor com informações inválidas \n";
        ret = false;
    } else {
        $("#divValor").removeClass("has-error").addClass("has-success");
    }

    if ($("#categoria").val().trim() == '') {
        $("#divCategoria").addClass("has-error");
        campos += "- Categoria \n";
        ret = false;
    } else {
        $("#divCategoria").removeClass("has-error").addClass("has-success");
    }

    if ($("#empresa").val() == '') {
        $("#divEmpresa").addClass("has-error");
        campos += "- Empresa \n";
        ret = false;
    } else {
        $("#divEmpresa").removeClass("has-error").addClass("has-success");
    }

    if ($("#conta").val().trim() == '') {
        $("#divConta").addClass("has-error");
        campos += "- Conta \n";
        ret = false;
    } else {
        $("#divConta").removeClass("has-error").addClass("has-success");
    }

    if (!ret) {
        alert("Preencher os campos: \n" + campos);
    } 
    return ret;

}
//------------------------------------VALIDANDO CADASTRO------------------------------------------//
function validarCadastro() {
    var ret = true;
    campos = "";
   
    if ($("#nome").val().trim() == '') {
        $("#divNome").addClass("has-error");
        ret = false;
        campos += "- Nome \n";
    } else {
        $("#divNome").removeClass("has-error").addClass("has-success");

    }
    if ($("#email").val().trim() == '') {
        $("#divEmail").addClass("has-error");
        ret = false;
        campos += "- Email \n";
    }else if (!validandoEmailCadastro($("#email").val().trim())) {
        $("#divEmail").addClass("has-error");
        ret = false;
        campos += "- Preecher o campo email corretamente! \n";
    } 
    else {
        $("#divEmail").removeClass("has-error").addClass("has-success");
    }

    if ($("#senha").val().trim() == '') {
        $("#divSenha").addClass("has-error");
        ret = false;
        campos += "- Senha \n";
    } else if ($("#senha").val().trim().length < 6) {
        $("#divSenha").addClass("has-error");
        ret = false;
        campos += "- Preecher o campo senha corretamente \n";
    } else {
        $("#divSenha").removeClass("has-error").addClass("has-success");
    }

    if ($("#senha").val().trim().length >= 6 && $("#rpsenha").val().trim() == '' ) {
        $("#divRSenha").addClass("has-error");
        ret = false
        campos += "- Repetir senha \n";
    } else if ($("#senha").val().trim().length >= 6 && $("#rpsenha").val().trim() != $("#senha").val().trim()) {
        $("#divRSenha").addClass("has-error");
        ret = false;
        campos += "- Repetir Senha está com informações inválidas";
    } else if($("#rpsenha").val().trim() == $("#senha").val().trim() && $("#senha").val().trim() != ''){
        $("#divRSenha").removeClass("has-error").addClass("has-success");
    }

    if (!ret) {
        alert("Preencher os campos: \n" + campos);
    }
    return ret;
}

function validandoEmailCadastro(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
  }
// -----------------------VALIDANDO LOGIN------------------------------------------------//
function validarLongin() {
    var ret = true;
    campos = "";
    if ($("#emailLogin").val().trim() == '') {
        $("#divEmailLogin").addClass("has-error");
        campos += "- E-mail \n";
        ret = false;
    }else if (!validandoEmailCadastro($("#emailLogin").val().trim())) {
        $("#divEmailLogin").addClass("has-error");
        ret = false;
        campos += "- Email preenchido incorretamente \n";
    } else {
        $("#divEmailLogin").removeClass("has-error").addClass("has-success");
    }

    if ($("#senhaLogin").val().trim() == '') {
        $("#divSenhaLogin").addClass("has-error");
        campos += "- Senha \n";
        ret = false;
    } else if ($("#senhaLogin").val().trim().length < 6) {
        $("#divSenhaLogin").addClass("has-error");
        ret = false;
        campos += "- Senha está com informações inválidas";
    }else {
        
        $("#divSenhaLogin").removeClass("has-error").addClass("has-success");
    }
    if (!ret) {
        alert("Preencher os campos: \n" + campos);
    }
    return ret;
}


// -----------------------VALIDANDO CONSULTAR PERIODO------------------------------------------------//
function validarConsultaPeriodo() {
    var ret = true;
    campos = "";
    if ($("#data").val().trim() == '') {
        $("#divData").addClass("has-error");
        campos += "- Data Inicial \n";
        ret = false;
    } else {
        $("#divData").removeClass("has-error").addClass("has-success");
    }

    if ($("#dataFinal").val().trim() == '') {
        $("#divDataFinal").addClass("has-error");
        campos += "- Data Final \n";
        ret = false;
    } else {
        $("#divDataFinal").removeClass("has-error").addClass("has-success");
    }
    if (!ret) {
        alert("Preencher os campos: \n" + campos);
    }
    return ret;
}

//=========================================================================================//

function mostrarRpSenhaCadastro() {
    const senha = document.getElementById('rpsenha');
    const icone = document.getElementById('iconeRpsenha');

    if (senha.type == 'password') {
        senha.setAttribute('type', 'text');
        icone.classList.add('fa fa-lock');
    } else {
        senha.setAttribute('type', 'password');
        icone.classList.remove('fa fa-lock');
    }
}

function mostrarSenhaCadastro() {
    const senha = document.getElementById('senha');
    const icone = document.getElementById('iconeSenha');

    if (senha.type == 'password') {
        senha.setAttribute('type', 'text');
        icone.classList.add('fa fa-lock');
    } else {
        senha.setAttribute('type', 'password');
        icone.classList.remove('fa fa-lock');
    }
}

function mostrarSenhaLogin() {
    const senha = document.getElementById('senhaLogin');
    const icone = document.getElementById('iconeSenhaLogin');

    if (senha.type == 'password') {
        senha.setAttribute('type', 'text');
        icone.classList.add('fa fa-lock');
    } else {
        senha.setAttribute('type', 'password');
        icone.classList.remove('fa fa-lock');
    }
}