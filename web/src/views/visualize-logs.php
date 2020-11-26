<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Página de usuário</title>
    <script src="../web/src/assets/js/menu.js"></script>
    <link rel="stylesheet" href="../web/src/assets/styles/css/menu.css" />
    <link rel="stylesheet" href="../web/src/assets/styles/css/header.css" />
    <link rel="stylesheet" href="../web/src/assets/styles/css/main.css" />
    <link rel="stylesheet" href="../web/src/assets/styles/css/register-client.css">
    <link
      href="https://fonts.googleapis.com/css2?family=Rhodium+Libre&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <header>
      <div class="bg-blue"></div>
      <div class="bg-yellow"></div>
    </header>
    <main class="main">
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
      <section class="main__page-content right-container">
        <div class="page-content__title">
          <h1 class="page-title mb">Visualizar logs</h1>
        </div>
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
        <form class="page-content__inputs mb">
          <div class="inputs-group mb">
            <label class="input-container input-container-50">
              Cod Origem
              <input disabled value='<?php echo "{$array['FK_ORIGEM']}" ?>' name="cod-origem" type="text" />
            </label>
            <label class="input-container input-container-50">
              Tabela
              <input disabled value='<?php echo "{$array['DS_TABELAORIGEM']}" ?>' name="tabela" type="text" />
            </label>
          </div>

          <div class="inputs-group ">
            <label class="input-container input-container-50">
              Ação
              <input disabled value='<?php echo "{$array['DS_ACAO']}" ?>' name="acao" type="text" />
            </label>
            <label class="input-container input-container-50">
              Hora da ação
              <input disabled value='<?php echo "{$array['DC_ACAO']}" ?>' name="hora-acao" type="text" />
            </label>
          </div>

          <div class="inputs-group">
            <label class="input-container input-container-50">
              Usuário
              <input disabled value='<?php echo "{$array['DS_LOGIN']}" ?>' name="usuario" type="text" />
            </label>
            <label class="input-container input-container-50">
              Rotina
              <input disabled value='<?php echo "{$array['DS_ROTINA']}" ?>' name="rotina" type="text" />
            </label>
          </div>

          <a href="../backend/logsconsultar.php"><button class="blue-button" type="button">Voltar</button></a>

        </form>
      </section>
    </main>
  </body>
</html>
