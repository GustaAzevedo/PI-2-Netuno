<?php 
session_start();
include_once "./config/db.php";

// validando usuário
if($_SESSION['idusuario'] = 0){
    header('Location: ../web/src/views/pg-login.html');
    exit();
}

// verificando se é uma alteração   
if(isset($_POST['pk_id'])){

    $id = preg_replace('/\D/','', $_POST['pk_id']);
    
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
    $inativo        = $_POST['inativo'] == 'on' ? 1 : 0;

    
    if(strlen($codigo) > 15){
        header('Location: ../web/src/views/register-product.php'); 
        $_SESSION['erro'] = true;
        $_SESSION['msgusu'] = 'Código tem mais caracter do que o suportado (Máx 15)!';
        exit();
    }

    //verificando Código
    $objSmtm = $objBanco -> prepare("SELECT PK_SKU FROM TB_PRODUTO WHERE DS_CODIGO = :CODIGO AND PK_SKU <> $id");
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

    $objSmtm = $objBanco -> prepare("UPDATE TB_PRODUTO SET
                                        DS_CODIGO      = :DS_CODIGO,
                                        DS_NOME        = :DS_NOME,
                                        DS_DESCRICAO   = :DS_DESCRICAO,
                                        VL_CUSTO       = :VL_CUSTO,
                                        VL_VENDA       = :VL_VENDA,
                                        QT_ESTOQUEATUAL = :QT_ESTOQUEATUAL,
                                        QT_ESTOQUEMIN   = :QT_ESTOQUEMIN,
                                        TG_INATIVO      = :TG_INATIVO,
                                        FK_MARCA        = :FK_MARCA,
                                        FK_CATEGORIA    = :FK_CATEGORIA,
                                        DH_ALTERACAO    = now()
                                    WHERE
                                        PK_SKU = $id");

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


    if( $objSmtm -> execute()){

        (__DIR__);
        include './functions/gravalog.php';

        $ret = Gravalog(intval($id), 'TB_PRODUTO', 'Alterou', 'Produto alterar');


        header('Location: ./produtoconsultar.php');
        $_SESSION['erro'] = false;
        $_SESSION['msgusu'] = 'Registro alterado com sucesso!';
        exit(); 
    }else{
        header('Location: ./produtoconsultar.php'); 
        $_SESSION['erro'] = true;
        $_SESSION['msgusu'] = 'Erro ao alterar o cadastro, tente novamente mais tarde!';
        exit();
    }

}else{

    $id = preg_replace('/\D/','', $_GET['id']);
    $query = "SELECT * FROM TB_PRODUTO WHERE PK_SKU = $id";
    $result = $objBanco -> query($query);
    $array = $result -> fetch(PDO::FETCH_ASSOC);

    $queryCT = "SELECT * FROM TB_CATEGORIA";
    $resultCT = $objBanco -> query($queryCT);
    $arrayCT = $resultCT -> fetch(PDO::FETCH_ASSOC);

    $queryMA = "SELECT * FROM TB_MARCA";
    $resultMA = $objBanco -> query($queryMA);
    $arrayMA = $resultMA -> fetch(PDO::FETCH_ASSOC);

    include "../web/src/views/produtoalterar.php";
}