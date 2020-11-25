<?php
session_start();
include_once "./config/db.php";

// validando usuário
if($_SESSION['idusuario'] = 0){
    header('Location: ../web/src/views/pg-login.html');
    exit();
}

//verificando razão
$objSmtm = $objBanco -> prepare("SELECT DS_RAZAO FROM TB_CLIENTE WHERE DS_RAZAO = :RAZAO");
$objSmtm -> bindparam(':RAZAO',$_POST['razao']);
$objSmtm -> execute();
$result = $objSmtm -> fetch(PDO::FETCH_ASSOC);
// se cair aqui, já existe cadastrado
if($result){
    header('Location: ../web/src/views/register-client.php'); 
    $_SESSION['erro'] = true;
    $_SESSION['msgusu'] = 'Razão social já cadastrada!';
    exit();
}

//verificando razão
$objSmtm = $objBanco -> prepare("SELECT NR_CPF FROM TB_CLIENTE WHERE NR_CPF = :CPF");
$cpfval = intval($_POST['cpf']) ?? 0;
$objSmtm -> bindparam(':CPF',$cpfval);
$objSmtm -> execute();
$result = $objSmtm -> fetch(PDO::FETCH_ASSOC);
// se cair aqui, já existe cadastrado
if($result){
    header('Location: ../web/src/views/register-client.php'); 
    $_SESSION['erro'] = true;
    $_SESSION['msgusu'] = 'CPF/CPNJ já cadastrado!';
    exit();
}

if($_POST['pessoa'] == 'F'){
    if(strlen($_POST['cpf']) != 11){
        header('Location: ../web/src/views/register-client.php'); 
        $_SESSION['erro'] = true;
        $_SESSION['msgusu'] = 'Número de dígitos para o tipo de pessoa inválido! (CPF)';
        exit();
    }
}else{
    if(strlen($_POST['cpf']) != 14){
        header('Location: ../web/src/views/register-client.php'); 
        $_SESSION['erro'] = true;
        $_SESSION['msgusu'] = 'Número de dígitos para o tipo de pessoa inválido! (CNPJ)';
        exit();
    }
}

if(strlen($_POST['cep']) != 8){
    header('Location: ../web/src/views/register-client.php'); 
    $_SESSION['erro'] = true;
    $_SESSION['msgusu'] = 'Número de dígitos para o CEP inválido!';
    exit();
}

//query de insert
$queryInsert = "INSERT INTO tb_cliente (DS_FANTASIA, 
                                        DS_RAZAO, 
                                        TG_PESSOA, 
                                        NR_CPF, 
                                        DS_EMAIL, 
                                        DS_TELEFONE, 
                                        DS_CELULAR, 
                                        DS_CEP, 
                                        DS_ENDERECO, 
                                        DS_NUMERO, 
                                        DS_CIDADE, 
                                        DS_COMPLEMENTO, 
                                        DS_REFERENCIA, 
                                        DS_OBSERVACAO, 
                                        TG_INATIVO, 
                                        DH_INCLUSAO,  
                                        FK_USUCRIADOR, 
                                        FK_ESTADO) 
                                VALUES (:fantasia,
                                        :razao,
                                        :pessoa,
                                        :cpf,
                                        :email,
                                        :telefone,
                                        :celular,
                                        :cep,
                                        :endereco,
                                        :numero,
                                        :cidade,
                                        :complemento,
                                        :referencia,
                                        :observacao,
                                        :inativo,
                                        now(),
                                        :usu,
                                        :estado)";

//preparando query
$objSmtm = $objBanco -> prepare($queryInsert);

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

$usercriador = intval($_SESSION['usersessao']['idusuario']);
$objSmtm -> bindparam(':usu', $usercriador);

$inativo = $_POST['inativo'] == '1' ? 1 : 0;
$objSmtm -> bindparam(':inativo', $inativo);

$return = $objSmtm -> execute();
$a = $objSmtm -> errorInfo();

if($return){

    (__DIR__);
    include './functions/gravalog.php';

    // grava log
    $objSmtm = $objBanco -> prepare("SELECT MAX(PK_ID) AS 'PK_ID' FROM TB_CLIENTE");
    $objSmtm -> execute();
    $result = $objSmtm -> fetch(PDO::FETCH_ASSOC);

    $ret = Gravalog(intval($result['PK_ID']), 'TB_CLIENTE', 'Incluiu', 'Cliente incluir');


    header('Location: ../web/src/views/register-client.php');
    $_SESSION['erro'] = false;
    $_SESSION['msgusu'] = 'Registro salvo com sucesso!';
    exit(); 
}else{
    header('Location: ../web/src/views/register-client.php'); 
    $_SESSION['erro'] = true;
    $_SESSION['msgusu'] = 'Erro ao salvar cadastro, tente novamente mais tarde!';
    exit();
}

