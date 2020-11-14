<?php

require_once 'config.php';

try{
    $objBanco = new PDO(DSN, DBUSER, DBPASS);
}
catch(PDOException $objerro){

    echo "Erro ao conectar-se ao banco de dados! <br> Erro:" . $objerro -> getMessage();
    exit();
}
