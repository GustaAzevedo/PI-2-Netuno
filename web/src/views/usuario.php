<?php include "../../../backend/functions/valida_user.php";?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/css/usuario.css">
    <link href="https://fonts.googleapis.com/css2?family=Rhodium+Libre&display=swap" rel="stylesheet">
    <title>Usuário</title>
</head>

<body>
    <header>
        <div class=" bg-blue">
        </div>
        <div class=" bg-yellow">
        </div>
        <nav class="sidebar">
            <ul class="sidebar__nav">
                <li class="nav__item">
                    <span class="item__title">
                        Cadastros <i> > </i>
                    </span>
                    <ul class="item__subnav">
                        <li class="subnav__item">
                            <a class="item__link" href="/">Clientes</a>
                        </li>
                        <li class="subnav__item">
                            <a class="item__link" href="/">Produtos</a>
                        </li>
                        <li class="subnav__item">
                            <a class="item__link" href="./usuario.html">Usuários</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="container-form">
            <h2 class="titulo">Usuários</h2>
            <?php 
                if($_SESSION['erro']){
                    echo '  <div class="invalido">
                                <p> '. $_SESSION["msgusu"] .'</p>
                            </div>';
                }else{
                    echo  '  <div class="valido">
                                <p> ' . $_SESSION["msgusu"] . '</p>
                            </div>';
                };  
            ?>
            
            <form method="POST" action="../../../backend/usuariodigitar.php">
            <div class="form">
                    <div class=" input">
                        <label class=" d-block" for="usuario" >Login*</label>
                        <input class=" d-block" type="text" name="ds_login" id="usuario" required>
                    </div>
                    <div class=" input">
                        <label class=" d-block" for="email-usuario">E-mai*</label>
                        <input class=" d-block" type="email" name="ds_email" required>
                    </div>
                </div>
                <div class="form-2">
                    <div class=" input">
                        <label class=" d-block" for="senha-usuario">Senha*</label>
                        <input class=" d-block" type="password" name="ds_senha" required>
                    </div>
                    <div class=" input">
                        <label class=" d-block" for="senha-usuario">Confirmar Senha*</label>
                        <input class=" d-block" type="password" name="ds_senhacon" required>
                    </div>
                </div>
                <div class="form-3">
                    <input type="checkbox"  name="tg_adm" value='1'>
                    <span>Perfil de Administrador</span>
                </div>
                <div class=" button">
                    <input class=" btn" type="submit" value="Salvar">
                    <input class=" btn-limpa" type="reset" value="Limpar">
                </div>
            </form>
        </div>
        </div>
    </main>
</body>

</html>