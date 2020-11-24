<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página de Clientes</title>
  <script src="../web/src/assets/js/menu.js"></script>
  <link rel="stylesheet" href="../web/src/assets/styles/css/menu.css">
  <link rel="stylesheet" href="../web/src/assets/styles/css/header.css">
  <link rel="stylesheet" href="../web/src/assets/styles/css/main.css">
  <link rel="stylesheet" href="../web/src/assets/styles/css/pg-users.css">
  <link href="https://fonts.googleapis.com/css2?family=Rhodium+Libre&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <div class="bg-blue">
    </div>
    <div class="bg-yellow">
    </div>
  </header>
  <main class="main">
    <nav class="sidebar">
        <ul class="sidebar__nav">
          <li class="nav__item hide-children">
            <span class="item__title">
              Cadastros 
              <img class="title__icon" src="../web/src/assets/svgs/arrow-down.svg" alt="arrow down">
            </span>
            <ul class="item__subnav">
              <li class="subnav__item">
                <a class="item__link" href="./clienteconsultar.php">Clientes</a>
              </li>
              <li class="subnav__item">
                <a class="item__link" href="./produtoconsultar.php">Produtos</a>
              </li>
              <li class="subnav__item">
                <a class="item__link" href="./usuarioconsultar.php">Usuários</a>
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
                <a class="item__link" href="#">Logs</a>
              </li>
              <li class="subnav__item">
                <a class="item__link" href="../backend/functions/logout.php">Logout</a>
              </li>
            </ul>
          </li>
        </ul>
        <a href="../web/src/views/welcome.php">
          <img src="../web/src/assets/images/logo.png" alt="netuno">
        </a>
    </nav>
    <section class="main__page-content right-container">
      <div class="page-content__title">
        <h1 class="title__text">Clientes</h1>
        <a href="../web/src/views/register-client.php">
          <button type="button" class="title__include">
            <img src="../web/src/assets/svgs/plus-square.svg" alt="+">
            Incluir Registro
          </button>
        </a>
      </div>
      <?php 
        $_SESSION['erro'] = $_SESSION['erro'] ?? '';
        $_SESSION['msgusu'] = $_SESSION['msgusu'] ?? '';
          if($_SESSION['erro']){
              echo '  <div class="invalido">
                          <p> '. $_SESSION["msgusu"] .'</p>
                      </div>';
                      $_SESSION['msgusu'] = '';
                      $_SESSION['erro']   = '';
          }else{
              echo  '  <div class="valido">
                          <p> ' . $_SESSION["msgusu"] . '</p>
                      </div>';
                      $_SESSION['msgusu'] = '';
                      $_SESSION['erro']   = '';
          };  
      ?>

      <form class="page-content__inputs" method='GET' action='../backend/clienteconsultar.php'>
        <label class="input-container inputs__login" name='ds_fantasia'>
          Fantasia
          <input type="text" class="input-container__input"  name='ds_fantasia'>
        </label>
        <label class="input-container inputs__email" name='nr_cpf'>
          CPF/CNPJ
          <input type="number" class="input-container__input"  name='nr_cpf'>
        </label>
        <button type="submit" class="inputs__search">
          <img src="../web/src/assets/svgs/search-icon.svg" alt="buscar">
          Buscar
        </button>
      </form>
      <table class="page-content__table"  border="0" cellpadding="0" cellspacing="0">
        <tr align="center">
          <th>Cód.</th>
          <th>Fantasia</th>
          <th>CPF/CPNJ</th>
          <th>Ação</th>
        </tr>
        <?php
          if(count($result) > 0){
            foreach ($result as $id => $reg){
              echo "<tr align='center'>
                      <td>{$reg['PK_ID']}</td>
                      <td>{$reg['DS_FANTASIA']}</td>
                      <td>{$reg['NR_CPF']}</td>
                      <td width='390'>
                        <a href='../backend/clientealterar.php?id={$reg['PK_ID']}'>
                          <button class='table__button table__edit' type='button'>
                            <img src='../web/src/assets/svgs/edit-icon.svg' alt='editar'>
                            Alterar
                          </button>
                        </a>
                        <a href='../backend/clientedeletar.php?id={$reg['PK_ID']}'>
                          <button class='table__button table__remove' type='button'>
                            <img src='../web/src/assets/svgs/trash-icon.svg' alt='remover'>
                            Excluir
                          </button>
                        </a>
                      </td>
            </tr>";
            }
          }
        ?>
      </table>
    </section>
  </main>
</body>
</html>