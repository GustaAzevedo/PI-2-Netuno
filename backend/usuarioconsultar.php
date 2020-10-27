<?php
session_start();
include_once "../backend/config/db.php";

// Se não tem sessão, volta para o login
if(!$_SESSION['usersessao']){
    header('Location: ../web/src/views/pg-login.html');
    exit();
}

// Listar registros
$_GET['ds_nome']    = $_GET['ds_nome'] ?? false;
$_GET['ds_email']   = $_GET['ds_email'] ?? false;


//Se nenhum foi preenchido, traz todos os regitros
if(!$_GET['ds_nome'] && !$_GET['ds_email']){
    $query = "SELECT PK_ID, DS_LOGIN, DS_EMAIL FROM TS_USUARIO WHERE TG_INATIVO = 0";
    $result = $objBanco -> Query($query);
    $objsmtm = $objBanco -> Query($query);
    $objsmtm -> execute();
    $count = $objsmtm -> fetch();
    include "../web/src/views/pg-user.php";
    exit();
}