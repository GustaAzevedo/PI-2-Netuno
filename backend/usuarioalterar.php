<?php 
session_start();
include_once "./config/db.php";

// validando usuário
if($_SESSION['idusuario'] = 0){
    header('Location: ../web/src/views/pg-login.html');
    exit();
}

var_dump($_POST);
// verificando se é uma alteração   
if(isset($_POST['pk_id'])){

    $id = preg_replace('/\D/','', $_POST['pk_id']);
    $adm      = $_POST['tg_adm'] ?? 0;

    $objSmtm = $objBanco -> prepare("UPDATE TS_USUARIO SET
                                        DS_LOGIN = :DS_LOGIN, 
                                        DS_SENHA = md5(:DS_SENHA), 
                                        DS_EMAIL = :DS_EMAIL,
                                        TG_ADM   = :TG_ADM,
                                      DH_ALTERACAO = now()
                                    WHERE
                                        PK_ID = $id");

    $objSmtm -> bindparam(':DS_LOGIN',$_POST['ds_login']);
    $objSmtm -> bindparam(':DS_SENHA',$_POST['ds_senha']);
    $objSmtm -> bindparam(':DS_EMAIL',$_POST['ds_email']);
    $objSmtm -> bindparam(':TG_ADM',intval($adm),PDO::PARAM_INT);
    
    if($objSmtm -> execute()){
        header('Location: ./usuarioconsultar.php');
        $_SESSION['erro'] = false;
        $_SESSION['msgusu'] = 'Registro alterado com sucesso!';
        exit(); 
    }else{
        header('Location: ./usuarioconsultar.php'); 
        $_SESSION['erro'] = true;
        $_SESSION['msgusu'] = 'Erro ao alterar o cadastro, tente novamente mais tarde!';
        exit();
    }

}else{

    $id = preg_replace('/\D/','', $_GET['id']);
    $query = "SELECT * FROM TS_USUARIO WHERE PK_ID = $id";
    $result = $objBanco -> query($query);
    $array = $result -> fetch(PDO::FETCH_ASSOC);

    include "../web/src/views/usuarioalterar.php";
}