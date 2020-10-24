<?php
session_start();
include_once "./config/db.php";


//verificando se o usuário tentou entrar sem credênciais 
if(empty($_POST['login']) || empty($_POST['senha'])){
    header('Location: ../web/src/views/pg-login.html');
    exit();
}

// Query para buscar usuário e senha no banco
$objSmtm = $objBanco -> prepare("SELECT PK_ID, DS_LOGIN, DS_EMAIL, TG_ADM FROM TS_USUARIO WHERE DS_LOGIN = :LOGIN AND DS_SENHA = md5(:SENHA)");

// Substituindo valores e executando
$objSmtm -> bindparam(':LOGIN',$_POST['login']);
$objSmtm -> bindparam(':SENHA',$_POST['senha']);
$objSmtm -> execute();

// Transformando em array
$result = $objSmtm -> fetch(PDO::FETCH_ASSOC);


//Verificando se voltou login e senha válidos
if($result){

    $_SESSION['usersessao'] = array('usuario' => $result['DS_LOGIN'], 
                                    'idusuario' => preg_replace('/\D/','', $result['PK_ID']), 
                                    'emailusuario' => $result['DS_EMAIL'], 
                                    'adm' => preg_replace('/\D/','', $result['TG_ADM']));
    header('Location: ../web/src/components/menu.html');
    exit();
}else{
    $_SESSION['idusuario'] = 0;
    header('Location: ../web/src/views/pg-login.php');
    exit();
}
