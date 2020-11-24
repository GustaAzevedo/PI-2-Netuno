<?php
session_start();
include_once "./config/db.php";

$_GET['id'] = $_GET['id'] ?? false;
$cod = $_GET['cod'] ?? '';

if($_SESSION['usersessao']['adm'] == 0){
    header('Location: ./produtoconsultar.php'); 
    $_SESSION['erro'] = true;
    $_SESSION['msgusu'] = 'Seu usuário não tem permissão para essa ação!';
    exit();
}

if($_GET['id']){
   
    $id = preg_replace('/\D/','', $_GET['id']);

    $result = $objBanco -> Query("DELETE FROM TB_PRODUTO WHERE PK_SKU = $id");

    // retornando resultado
    if($result !== false){
        header('Location: ./produtoconsultar.php'); 
        $_SESSION['erro'] = false;
        $_SESSION['msgusu'] = "Produto $cod deletado com sucesso!";
        exit();
    }else{
        header('Location: ./produtoconsultar.php'); 
        $_SESSION['erro'] = true;
        $_SESSION['msgusu'] = 'Erro ao deletar o registro, tente novamente mais tarde!';
        exit();
    }
}else{

    header('Location: ./produtoconsultar.php'); 
    $_SESSION['erro'] = true;
    $_SESSION['msgusu'] = 'Erro ao deletar o registro, tente novamente mais tarde!';
    exit();
}