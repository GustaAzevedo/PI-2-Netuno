<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../web/src/assets/styles/css/usuario.css">
    <link rel="stylesheet" href="../web/src/assets/styles/css/menu.css">
    <link href="https://fonts.googleapis.com/css2?family=Rhodium+Libre&display=swap" rel="stylesheet">
    <script src="../web/src/assets/js/menu.js"></script>
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
          <li class="nav__item hide-children">
            <span class="item__title">
              Cadastros
              <img
                class="title__icon"
                src="../web/src/assets/svgs/arrow-down.svg"
                alt="arrow down"
              />
            </span>
            <ul class="item__subnav">
              <li class="subnav__item">
                <a class="item__link" href="../backend/clienteconsultar.php">Clientes</a>
              </li>
              <li class="subnav__item">
                <a class="item__link" href="../backend/produtoconsultar.php">Produtos</a>
              </li>
              <li class="subnav__item">
                <a class="item__link" href="../backend/usuarioconsultar.php">Usuários</a>
              </li>
            </ul>
          </li>
          <li class="nav__item hide-children">
            <span class="item__title">
              Mais
              <img
                class="title__icon"
                src="../web/src/assets/svgs/arrow-down.svg"
                alt="arrow down"
              />
            </span>
            <ul class="item__subnav">
              <li class="subnav__item">
                <a class="item__link" href="../backend/logsconsultar.php">Logs</a>
              </li>
              <li class="subnav__item">
                <a class="item__link" href="../backend/functions/logout.php">Logout</a>
              </li>
            </ul>
          </li>
        </ul>
        <a href="../web/src/views/welcome.php">
          <img src="../web/src/assets/images/logo.png" alt="netuno" />
        </a>
      </nav>
    </header>

    <main>
        <div class="container-form">
            <h2 class="titulo">Usuários(Alterar)</h2>
            <?php 
              $_SESSION['erro'] = $_SESSION['erro'] ?? '';
              $_SESSION['msgusu'] = $_SESSION['msgusu'] ?? '';
                if($_SESSION['erro']){
                    echo '  <div class="invalido">
                                <p> '. $_SESSION["msgusu"] .'</p>
                            </div>';
                            $_SESSION['msgusu'] = '';
                }else{
                    echo  '  <div class="valido">
                                <p> ' . $_SESSION["msgusu"] . '</p>
                            </div>';
                            $_SESSION['msgusu'] = '';
                };  
            ?>
            
            <form method="POST" action="../backend/usuarioalterar.php">
            <div class="form">
                    <div class=" input">
                        <label class=" d-block" for="usuario" >Login*</label>
                        <input class=" d-block" type="text" name="ds_login" id="usuario" value='<?php echo "{$array['DS_LOGIN']}"?>' required>
                    </div>
                    <div class=" input">
                        <label class=" d-block" for="email-usuario">E-mail*</label>
                        <input class=" d-block" type="email" name="ds_email"  value='<?php echo "{$array['DS_EMAIL']}"?>' required disabled="">
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
                    <input type="checkbox"  name='tg_adm' <?php if($array['TG_ADM'] == 1){ $cond = "value='1' checked";}else{ $cond = "value='1'";}echo"$cond";?>>
                    <span>Perfil de Administrador</span>
                    <input type="hidden" name='pk_id' value='<?php echo "{$array['PK_ID']}" ?>'>
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