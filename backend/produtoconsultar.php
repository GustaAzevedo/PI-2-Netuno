<?php
session_start();
include_once "../backend/config/db.php";

// Se não tem sessão, volta para o login
if(!$_SESSION['usersessao']){
    header('Location: ../web/src/views/pg-login.html');
    exit();
}

// Listar registros
$_GET['codigo']         = $_GET['codigo'] ?? false;
$_GET['name']           = $_GET['name']   ?? false;
$_GET['categoria']      = $_GET['categoria']   ?? false;



//Se nenhum foi preenchido, traz todos os regitros
if(!$_GET['codigo']  && !$_GET['name'] && !$_GET['categoria']){
    $query = "SELECT 
                    PRO.PK_SKU, 
                    PRO.DS_CODIGO, 
                    PRO.DS_NOME, 
                    CAT.DS_CATEGORIA 
                FROM 
                    TB_PRODUTO AS PRO 
                    LEFT JOIN TB_CATEGORIA AS CAT ON CAT.PK_ID = PRO.FK_CATEGORIA 
                WHERE 
                    PRO.TG_INATIVO = 0";
    $objsmtm = $objBanco -> prepare($query);
    $objsmtm -> execute();
    $result = $objsmtm -> fetchall();
    $count = $objsmtm -> fetchall();
    include "../web/src/views/pg-products.php";
 
}else{

    $codigo     = $_GET['codigo'] ?? '';
    $nome       = $_GET['name'] ?? '';
    $categoria  = intval($_GET['categoria']) ?? 0;

    $query = "SELECT 
                    PRO.PK_SKU, 
                    PRO.DS_CODIGO, 
                    PRO.DS_NOME, 
                    CAT.DS_CATEGORIA 
                FROM 
                    TB_PRODUTO AS PRO 
                    LEFT JOIN TB_CATEGORIA AS CAT ON CAT.PK_ID = PRO.FK_CATEGORIA 
                WHERE 
                    PRO.TG_INATIVO = 0";

    //Adicionando as condições para pesquisa
    if($codigo != ''){
        $query = $query . " AND PRO.DS_CODIGO LIKE :codigo";
    }
    if($nome != ''){
        $query = $query . " AND PRO.DS_NOME LIKE :nome";
    }
    if($categoria != 0){
        $query = $query . " AND PRO.FK_CATEGORIA = :categoria";
    }

    //Trocando as condições
    $objSmtm = $objBanco -> prepare($query);
    if($codigo != ''){
        $likecodigo = $codigo . '%';
        $objSmtm -> bindparam(':codigo', $likecodigo);
    }
    if($nome != ''){
        $likenome = $nome . '%';
        $objSmtm -> bindparam(':nome', $likenome);
    }
    if($categoria != 0){
        $objSmtm -> bindparam(':categoria',$categoria);
    }

    //Passando para a tela
    $objSmtm -> execute();
    $result = $objSmtm -> fetchall();
    $count = $objSmtm -> fetchall();

    include "../web/src/views/pg-products.php";
}
