<?php
session_start();
include_once "../backend/config/db.php";

// Se não tem sessão, volta para o login
if(!$_SESSION['usersessao']){
    header('Location: ../web/src/views/pg-login.html');
    exit();
}

// Listar registros
$_GET['ds_fantasia']   = $_GET['ds_fantasia'] ?? false;
$_GET['nr_cpf']        = $_GET['nr_cpf'] ?? false;



//Se nenhum foi preenchido, traz todos os regitros
if(!$_GET['ds_fantasia'] && !$_GET['nr_cpf']){
    $query = "SELECT PK_ID, DS_FANTASIA, NR_CPF FROM TB_CLIENTE WHERE TG_INATIVO = 0";
    $objsmtm = $objBanco -> prepare($query);
    $objsmtm -> execute();
    $result = $objsmtm -> fetchall();
    $count = $objsmtm -> fetchall();
    include "../web/src/views/pg-clientes.php";
 
}else{

    $fantasia  = $_GET['ds_fantasia'] ?? '';
    $cpf   = intval($_GET['nr_cpf']) ?? 0;

    $query = "SELECT PK_ID, DS_FANTASIA, NR_CPF FROM TB_CLIENTE WHERE TG_INATIVO = 0";

    //Adicionando as condições para pesquisa
    if($fantasia != ''){
        $query = $query . " AND DS_FANTASIA LIKE :fantasia";
    }
    if($cpf != ''){
        $query = $query . " AND NR_CPF = :cpf";
    }

    //Trocando as condições
    $objSmtm = $objBanco -> prepare($query);
    if($fantasia != ''){
        $likefantasia = $fantasia . '%';
        $objSmtm -> bindparam(':fantasia', $likefantasia);
    }
    if($cpf != 0){
        $objSmtm -> bindparam(':cpf',$cpf);
    }

    //Passando para a tela
    $objSmtm -> execute();
    $result = $objSmtm -> fetchall();
    $count = $objSmtm -> fetchall();

    include "../web/src/views/pg-clientes.php";

}
