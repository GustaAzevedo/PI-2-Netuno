<?php
session_start();


// Se não tem sessão, volta para o login
if(!$_SESSION['usersessao']){
    header('Location: ../web/src/views/pg-login.html');
    exit();
}

