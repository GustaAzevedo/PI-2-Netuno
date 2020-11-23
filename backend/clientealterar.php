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
    
   //verificando razão
    $objSmtm = $objBanco -> prepare("SELECT PK_ID, DS_RAZAO FROM TB_CLIENTE WHERE DS_RAZAO = :RAZAO AND PK_ID <> $id");
    $objSmtm -> bindparam(':RAZAO',$_POST['razao']);
    $objSmtm -> execute();
    $result = $objSmtm -> fetch(PDO::FETCH_ASSOC);
    // se cair aqui, já existe cadastrado
    if($result){
        header("Location: ./clientealterar.php?id=$id");
        $_SESSION['erro'] = true;
        $_SESSION['msgusu'] = 'Razão social já cadastrada!';
        
        exit();
    }

    //verificando razão
    $objSmtm = $objBanco -> prepare("SELECT PK_ID, NR_CPF FROM TB_CLIENTE WHERE NR_CPF = :CPF AND PK_ID <> $id");
    $cpfval = intval($_POST['cpf']) ?? 0;
    $objSmtm -> bindparam(':CPF',$cpfval);
    $objSmtm -> execute();
    $result = $objSmtm -> fetch(PDO::FETCH_ASSOC);
    // se cair aqui, já existe cadastrado
    if($result){
        header("Location: ./clientealterar.php?id=$id");
        $_SESSION['erro'] = true;
        $_SESSION['msgusu'] = 'CPF/CPNJ já cadastrado!';
        exit();
    }

    if($_POST['pessoa'] == 'F'){
        if(strlen($_POST['cpf']) != 11){
            header("Location: ./clientealterar.php?id=$id");
            $_SESSION['erro'] = true;
            $_SESSION['msgusu'] = 'Número de dígitos para o tipo de pessoa inválido! (CPF)';
            exit();
        }
    }else{
        if(strlen($_POST['cpf']) != 14){
            header("Location: ./clientealterar.php?id=$id");
            $_SESSION['erro'] = true;
            $_SESSION['msgusu'] = 'Número de dígitos para o tipo de pessoa inválido! (CNPJ)';
            exit();
        }
    }
    
    if(strlen($_POST['cep']) != 8){
        header("Location: ./clientealterar.php?id=$id");
        $_SESSION['erro'] = true;
        $_SESSION['msgusu'] = 'Número de dígitos para o CEP inválido!';
        exit();
    }

    $objSmtm = $objBanco -> prepare("UPDATE TB_CLIENTE SET
                                        DS_FANTASIA     = :fantasia,
                                        DS_RAZAO        = :razao,
                                        TG_PESSOA       = :pessoa,
                                        NR_CPF          = :cpf,
                                        DS_EMAIL        = :email,
                                        DS_TELEFONE     = :telefone,
                                        DS_CELULAR      = :celular,
                                        DS_CEP          = :cep,
                                        DS_ENDERECO     = :endereco,
                                        DS_NUMERO       = :numero,
                                        DS_CIDADE       = :cidade,
                                        DS_COMPLEMENTO  = :complemento,
                                        DS_REFERENCIA   = :referencia,
                                        DS_OBSERVACAO   = :observacao,
                                        TG_INATIVO      = :inativo,
                                        FK_ESTADO       = :estado,
                                        DH_ALTERACAO    = now()
                                    WHERE
                                        PK_ID = $id");

    // substituindo os valores
    $fantasia = $_POST['fantasia'] ?? '';
    $objSmtm -> bindparam(':fantasia',$fantasia);

    $razao = $_POST['fantasia'] ?? '';
    $objSmtm -> bindparam(':razao',$razao);

    $pessoa = $_POST['pessoa'] ?? '';
    $objSmtm -> bindparam(':pessoa',$pessoa);

    $objSmtm -> bindparam(':cpf', $cpfval );

    $email = $_POST['email'] ?? '';
    $objSmtm -> bindparam(':email', $email );

    $telefone = $_POST['telefone'] ?? '';
    $objSmtm -> bindparam(':telefone', $telefone);

    $celular = $_POST['celular'] ?? '';
    $objSmtm -> bindparam(':celular', $celular);

    $cep = $_POST['cep'] ?? '';
    $objSmtm -> bindparam(':cep', $cep);

    $endereco = $_POST['endereco'] ?? '';
    $objSmtm -> bindparam(':endereco', $endereco);

    $numero = $_POST['numero'] ?? '';
    $objSmtm -> bindparam(':numero', $numero) ;

    $cidade = $_POST['cidade'] ?? '';
    $objSmtm -> bindparam(':cidade', $cidade);

    $complemento = $_POST['complemento'] ?? '';
    $objSmtm -> bindparam(':complemento', $complemento);

    $referencia = $_POST['referencia'] ?? '';
    $objSmtm -> bindparam(':referencia', $referencia);

    $observacao = $_POST['observacao'] ?? '';
    $objSmtm -> bindparam(':observacao', $observacao);

    $estado = $_POST['estado'] ?? '';
    $objSmtm -> bindparam(':estado', $estado);

    $inativo = isset($_POST['inativo']) ? 1 : 0;
    $objSmtm -> bindparam(':inativo', $inativo);

    
    if($objSmtm -> execute()){
        header('Location: ./clienteconsultar.php');
        $_SESSION['erro'] = false;
        $_SESSION['msgusu'] = 'Registro alterado com sucesso!';
        exit(); 
    }else{
        header('Location: ./clienteconsultar.php'); 
        $_SESSION['erro'] = true;
        $_SESSION['msgusu'] = 'Erro ao alterar o cadastro, tente novamente mais tarde!';
        exit();
    }

}else{

    $id = preg_replace('/\D/','', $_GET['id']);
    $query = "SELECT * FROM TB_CLIENTE WHERE PK_ID = $id";
    $result = $objBanco -> query($query);
    $array = $result -> fetch(PDO::FETCH_ASSOC);

    $queryES = "SELECT * FROM TB_ESTADO";
    $resultES = $objBanco -> query($queryES);
    $arrayES = $resultES -> fetch(PDO::FETCH_ASSOC);

    include "../web/src/views/clientealterar.php";
}