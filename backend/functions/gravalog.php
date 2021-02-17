<?php

//função que vai gravar o log
function Gravalog (int $codorigem, string $tabela, string $acao, string $rotina){

    global $objBanco;

    $queryLog = "INSERT INTO ts_log(FK_ORIGEM,
                                    DS_TABELAORIGEM,
                                    DS_ACAO,
                                    DH_ACAO,
                                    DS_ROTINA,
                                    FK_USUACAO)
                            VALUES( $codorigem,
                                    '$tabela',
                                    '$acao',
                                    now(),
                                    '$rotina'," . $_SESSION['usersessao']['idusuario'] . ")";

    var_dump( $queryLog);

    
    $retorno = $objBanco -> query($queryLog);

    if($retorno){
        return 1;
    }else{
        return 0;
    }
}