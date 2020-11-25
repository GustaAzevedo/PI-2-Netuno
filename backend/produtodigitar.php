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
$nome       = $_POST['name'];
$codigo     = $_POST['codigo'];
$marca      = intval($_POST['marca']) ?? 0;
$categoria  = intval($_POST['categoria']) ?? 0;
$precovenda = intval($_POST['preco-venda']) ?? 0;
$precocusto = intval($_POST['preco-custo']) ?? 0;
$estoqueatual   = intval($_POST['estoque-atual']) ?? 0;
$estoquemin     = intval($_POST['estoque-minimo']) ?? 0;
$descricao      = $_POST['descricao'];      
$inativo        = $_POST['inativo'] == '1' ? 1 : 0;


if(strlen($codigo) > 15){
    header('Location: ../web/src/views/register-product.php'); 
    $_SESSION['erro'] = true;
    $_SESSION['msgusu'] = 'Código tem mais caracter do que o suportado (Máx 15)!';
    exit();
}

//verificando Código
$objSmtm = $objBanco -> prepare("SELECT PK_SKU FROM TB_PRODUTO WHERE DS_CODIGO = :CODIGO");
$objSmtm -> bindparam(':CODIGO',$codigo);
$objSmtm -> execute();
$result = $objSmtm -> fetch(PDO::FETCH_ASSOC);
// se cair aqui, já existe cadastrado
if($result){
    header('Location: ../web/src/views/usuario.php'); 
    $_SESSION['erro'] = true;
    $_SESSION['msgusu'] = 'Código já cadastrado!';
    exit();
}

//query de insert
$queryInsert = "INSERT INTO TB_PRODUTO(DS_CODIGO,
                                        DS_NOME,
                                        DS_DESCRICAO,
                                        VL_CUSTO,
                                        VL_VENDA,
                                        QT_ESTOQUEATUAL,
                                        QT_ESTOQUEMIN,
                                        TG_INATIVO,
                                        DH_INCLUSAO,
                                        FK_USUCRIADOR,
                                        FK_MARCA,
                                        FK_CATEGORIA)
                            VALUES(:DS_CODIGO,
                                    :DS_NOME,
                                    :DS_DESCRICAO,
                                    :VL_CUSTO,
                                    :VL_VENDA,
                                    :QT_ESTOQUEATUAL,
                                    :QT_ESTOQUEMIN,
                                    :TG_INATIVO,
                                    NOW(),
                                    :FK_USUCRIADOR,
                                    :FK_MARCA,
                                    :FK_CATEGORIA)";

//preparando query
$objSmtm = $objBanco -> prepare($queryInsert);

// substituindo os valores
$objSmtm -> bindparam(':DS_CODIGO',$codigo);
$objSmtm -> bindparam(':DS_NOME',$nome);
$objSmtm -> bindparam(':DS_DESCRICAO',$descricao);
$objSmtm -> bindparam(':VL_CUSTO',$precocusto);
$objSmtm -> bindparam(':VL_VENDA',$precovenda);
$objSmtm -> bindparam(':QT_ESTOQUEATUAL',$estoqueatual);
$objSmtm -> bindparam(':QT_ESTOQUEMIN',$estoquemin);
$objSmtm -> bindparam(':TG_INATIVO',$inativo);
$objSmtm -> bindparam(':FK_CATEGORIA',$categoria);
$objSmtm -> bindparam(':FK_MARCA',$marca);
$objSmtm -> bindparam(':FK_USUCRIADOR',$_SESSION['usersessao']['idusuario']);

$return = $objSmtm -> execute();


if($return){

    (__DIR__);
    include './functions/gravalog.php';

    // grava log
    $objSmtm = $objBanco -> prepare("SELECT MAX(PK_ID) AS 'PK_ID' FROM TB_PRODUTO");
    $objSmtm -> execute();
    $result = $objSmtm -> fetch(PDO::FETCH_ASSOC);

    $ret = Gravalog(intval($result['PK_ID']), 'TB_PRODUTO', 'Incluiu', 'Produto incluir');

    header('Location: ../web/src/views/register-product.php');
    $_SESSION['erro'] = false;
    $_SESSION['msgusu'] = 'Registro salvo com sucesso!';
    exit(); 
}else{
    header('Location: ../web/src/views/register-product.php');
    $_SESSION['erro'] = true;
    $_SESSION['msgusu'] = 'Erro ao salvar cadastro, tente novamente mais tarde!';
    exit();
}

