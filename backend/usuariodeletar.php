<?php
session_start();
include_once "./config/db.php";

$_GET['id'] = $_GET['id'] ?? false;

if($_SESSION['usersessao']['adm'] == 0){
    header('Location: ./usuarioconsultar.php'); 
    $_SESSION['erro'] = true;
    $_SESSION['msgusu'] = 'Seu usuário não tem permissão para essa ação!';
    exit();
}

if($_SESSION['usersessao']['idusuario'] == $_GET['id']){
    header('Location: ./usuarioconsultar.php'); 
    $_SESSION['erro'] = true;
    $_SESSION['msgusu'] = 'Não pode excluir o usuário logado atualmente!';
    exit();
}


if($_GET['id']){
   
    $id = preg_replace('/\D/','', $_GET['id']);

    $result = $objBanco -> Query("DELETE FROM TS_USUARIO WHERE PK_ID = $id");

    // retornando resultado
    if($result !== false){
        header('Location: ./usuarioconsultar.php'); 
        $_SESSION['erro'] = false;
        $_SESSION['msgusu'] = "Usuário $id deletado com sucesso!";
        exit();
    }else{
        header('Location: ./usuarioconsultar.php'); 
        $_SESSION['erro'] = true;
        $_SESSION['msgusu'] = 'Erro ao deletar o registro, tente novamente mais tarde!';
        exit();
    }
}else{

    header('Location: ./usuarioconsultar.php'); 
    $_SESSION['erro'] = true;
    $_SESSION['msgusu'] = 'Erro ao deletar o registro, tente novamente mais tarde!';
    exit();
}