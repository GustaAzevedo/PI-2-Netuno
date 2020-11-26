<?php
session_start();
include_once "../backend/config/db.php";

// Se não tem sessão, volta para o login
if(!$_SESSION['usersessao']){
    header('Location: ../web/src/views/pg-login.html');
    exit();
}

if($_SESSION['usersessao']['adm'] == 0){
    $query = "SELECT PK_ID, FK_ORIGEM, DS_TABELAORIGEM, DS_ACAO FROM TS_LOG WHERE PK_ID = 0";
    $objsmtm = $objBanco -> prepare($query);
    $objsmtm -> execute();
    $result = $objsmtm -> fetchall();
    $count = $objsmtm -> fetchall();
    $_SESSION['erro'] = true;
    $_SESSION['msgusu'] = 'Seu usuário não tem permissão para ver logs!';
    include "../web/src/views/pg-logs.php";
    exit();
}

// Listar registros
$_GET['cod']    = $_GET['cod'] ?? false;
$_GET['tabela'] = $_GET['tabela'] ?? false;


//Se nenhum foi preenchido, traz todos os regitros
if(!$_GET['cod'] && !$_GET['tabela']){
    $query = "SELECT PK_ID, FK_ORIGEM, DS_TABELAORIGEM, DS_ACAO, DATE_FORMAT(DH_ACAO,'%d/%m/%Y %T') AS 'DC_ACAO' FROM TS_LOG ";
    $objsmtm = $objBanco -> prepare($query);
    $objsmtm -> execute();
    $result = $objsmtm -> fetchall();
    $count = $objsmtm -> fetchall();
    include "../web/src/views/pg-logs.php";
 
}else{

    $cod    = $_GET['cod'] ?? 0;
    $tabela = $_GET['tabela'] ?? '';

    $query = "SELECT PK_ID, FK_ORIGEM, DS_TABELAORIGEM, DS_ACAO, DATE_FORMAT(DH_ACAO,'%d/%m/%Y %T') AS 'DC_ACAO' FROM TS_LOG WHERE PK_ID <> 0";

    //Adicionando as condições para pesquisa
    if($cod != 0){
        $query = $query . " AND FK_ORIGEM = :cod";
    }
    if($tabela != ''){
        $query = $query . " AND DS_TABELAORIGEM = :tabela";
    }

    //Trocando as condições
    $objSmtm = $objBanco -> prepare($query);
    if($cod != 0){
        $objSmtm -> bindparam(':cod', $cod);
    }
    if($tabela != ''){
        $objSmtm -> bindparam(':tabela',$tabela);
    }

    //Passando para a tela
    $objSmtm -> execute();
    $result = $objSmtm -> fetchall();
    $count = $objSmtm -> fetchall();

    include "../web/src/views/pg-logs.php";

}