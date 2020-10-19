<?php
session_start();
include_once "./config/db.php";

// validando usuário
if($_SESSION['idusuario'] = 0){
    header('Location: ../web/src/views/pg-login.html');
    exit();
}

include "./functions/valida_user.php";

//pegando variaveis
$login    = $_POST['ds_login'];
$email    = $_POST['ds_email'];
$senha    = $_POST['ds_senha'];
$senhacon = $_POST['ds_senhacon'];
$adm      = $_POST['tg_adm'] ?? 0;



if($senha != $senhacon){
    header('Location: ../web/src/views/usuario.php'); 
    $_SESSION['erro'] = true;
    $_SESSION['msgusu'] = 'As senhas não são iguais!';
    exit();
}

//verificando login
$objSmtm = $objBanco -> prepare("SELECT DS_LOGIN FROM TS_USUARIO WHERE DS_LOGIN = :LOGIN");
$objSmtm -> bindparam(':LOGIN',$login);
$objSmtm -> execute();
$result = $objSmtm -> fetch(PDO::FETCH_ASSOC);
// se cair aqui, já existe cadastrado
if($result){
    header('Location: ../web/src/views/usuario.php'); 
    $_SESSION['erro'] = true;
    $_SESSION['msgusu'] = 'Login já cadastrado!';
    exit();
}


//verificando email
$objSmtm = $objBanco -> prepare("SELECT DS_EMAIL FROM TS_USUARIO WHERE DS_EMAIL = :EMAIL");
$objSmtm -> bindparam(':EMAIL',$email );
$objSmtm -> execute();
$result = $objSmtm -> fetch(PDO::FETCH_ASSOC);
// se cair aqui, já existe cadastrado
if($result){
    header('Location: ../web/src/views/usuario.php'); 
    $_SESSION['erro'] = true;
    $_SESSION['msgusu'] = 'E-mail já cadastrado!';
    exit();
}

//query de insert
$queryInsert = "insert into ts_usuario (DS_LOGIN, DS_EMAIL, DS_SENHA, TG_ADM, DH_INCLUSAO, FK_USUCRIADOR) 
                                        values (:ds_login, :ds_email,  md5(:ds_senha), :tg_adm, now(), :fk_usucriador)";

//preparando query
$objSmtm = $objBanco -> prepare($queryInsert);

// substituindo os valores
$objSmtm -> bindparam(':ds_login',$login);
$objSmtm -> bindparam(':ds_email',$email);
$objSmtm -> bindparam(':ds_senha',$senha);
$objSmtm -> bindparam(':tg_adm',intval($adm),PDO::PARAM_INT);
$objSmtm -> bindparam(':fk_usucriador',intval($_SESSION['usersessao']['idusuario']),PDO::PARAM_INT);

$return = $objSmtm -> execute();

if($return){
    header('Location: ../web/src/views/usuario.php');
    $_SESSION['erro'] = false;
    $_SESSION['msgusu'] = 'Registro salvo com sucesso!';
    exit(); 
}else{
    header('Location: ../web/src/views/usuario.php'); 
    $_SESSION['erro'] = true;
    $_SESSION['msgusu'] = 'Erro ao salvar cadastro, tente novamente mais tarde!';
    exit();
} 

