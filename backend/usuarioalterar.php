<?php 
session_start();
include_once "./config/db.php";

// validando usuário
if($_SESSION['usersessao']['idusuario'] == 0){
    header('Location: ./pg-login.html');
    exit();
}

if($_SESSION['usersessao']['adm'] == 0){
    header('Location: ./usuarioconsultar.php'); 
    $_SESSION['erro'] = true;
    $_SESSION['msgusu'] = 'Você não tem permissão para alterar usuários!';
    exit();
}


// verificando se é uma alteração   
if(isset($_POST['pk_id'])){

    $id = preg_replace('/\D/','', $_POST['pk_id']);
    //pegando variaveis
    $login    = $_POST['ds_login'];
    $senha    = $_POST['ds_senha'];
    $senhacon = $_POST['ds_senhacon'];
    $adm      = $_POST['tg_adm'] ?? 0;

    
    if($senha != $senhacon){

        //montando o registro para alterar
        $query = "SELECT * FROM TS_USUARIO WHERE PK_ID = $id";
        $result = $objBanco -> query($query);
        $array = $result -> fetch(PDO::FETCH_ASSOC);

        //substituindo os valores para continuar com o que foi digitado
        $array['DS_LOGIN']  = $login;
        $array['TG_ADM']    = $adm ;

        //passando para a tela
        $_SESSION['erro'] = true;
        $_SESSION['msgusu'] = 'As senhas não são iguais!';
        include "../web/src/views/usuarioalterar.php";
        exit();
    }

    //verificando login
    $objSmtm = $objBanco -> prepare("SELECT DS_LOGIN FROM TS_USUARIO WHERE DS_LOGIN = :LOGIN AND PK_ID <> $id");
    $objSmtm -> bindparam(':LOGIN',$login);
    $objSmtm -> execute();
    $result = $objSmtm -> fetch(PDO::FETCH_ASSOC);
    // se cair aqui, já existe cadastrado
    if($result){
        
        //montando o registro para alterar
        $query = "SELECT * FROM TS_USUARIO WHERE PK_ID = $id";
        $result = $objBanco -> query($query);
        $array = $result -> fetch(PDO::FETCH_ASSOC);

        //substituindo os valores para continuar com o que foi digitado
         $array['DS_LOGIN']  = $login;
         $array['TG_ADM']    = $adm ;
 
        //passando para a tela
        $_SESSION['erro'] = true;
        $_SESSION['msgusu'] = 'Login já cadastrado!';
        include "../web/src/views/usuarioalterar.php";
        
        exit();
    }

    //Criptografando
    $senha = password_hash($senha,PASSWORD_DEFAULT);


    $objSmtm = $objBanco -> prepare("UPDATE TS_USUARIO SET
                                        DS_LOGIN = :DS_LOGIN, 
                                        DS_SENHA = :DS_SENHA, 
                                        TG_ADM   = :TG_ADM,
                                      DH_ALTERACAO = now()
                                    WHERE
                                        PK_ID = $id");

    $objSmtm -> bindParam(':DS_LOGIN',$login);
    $objSmtm -> bindParam(':DS_SENHA',$senha);
    $objSmtm -> bindParam(':TG_ADM',$adm);
    
    
    if($objSmtm -> execute()){

        (__DIR__);
        include './functions/gravalog.php';

        $ret = Gravalog(intval($id), 'TS_USUARIO', 'Alterou', 'Usuário alterar');


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