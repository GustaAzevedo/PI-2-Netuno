<?php
session_start();
include_once "../backend/config/db.php";

// Se não tem sessão, volta para o login
if(!$_SESSION['usersessao']){
    header('Location: ../web/src/views/pg-login.html');
    exit();
}

// Listar registros
$_GET['ds_login']    = $_GET['ds_login'] ?? false;
$_GET['ds_email']   = $_GET['ds_email'] ?? false;


//Se nenhum foi preenchido, traz todos os regitros
if(!$_GET['ds_login'] && !$_GET['ds_email']){
    $query = "SELECT PK_ID, DS_LOGIN, DS_EMAIL FROM TS_USUARIO WHERE TG_INATIVO = 0";
    $objsmtm = $objBanco -> prepare($query);
    $objsmtm -> execute();
    $result = $objsmtm -> fetchall();
    $count = $objsmtm -> fetchall();
    include "../web/src/views/pg-user.php";
 
}else{

    $login   = $_GET['ds_login'] ?? '';
    $email   = $_GET['ds_email'] ?? '';

    $query = "SELECT PK_ID, DS_LOGIN, DS_EMAIL FROM TS_USUARIO WHERE TG_INATIVO = 0";

    //Adicionando as condições para pesquisa
    if($login != ''){
        $query = $query . " AND DS_LOGIN LIKE :login";
    }
    if($email != ''){
        $query = $query . " AND DS_EMAIL LIKE :email";
    }

    //Trocando as condições
    $objSmtm = $objBanco -> prepare($query);
    if($login != ''){
        $likelogin = $login . '%';
        $objSmtm -> bindparam(':login', $likelogin);
    }
    if($email != ''){
        $likeemail = $email . '%';
        $objSmtm -> bindparam(':email',$likeemail);
    }

    //Passando para a tela
    $objSmtm -> execute();
    $result = $objSmtm -> fetchall();
    $count = $objSmtm -> fetchall();

    include "../web/src/views/pg-user.php";

}