
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro de produto</title>
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
          <h1 class="page-title mb">Produtos(Alterar)</h1>
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
        <form class="page-content__inputs mb" method='POST' action='../backend/produtoalterar.php'>
          <div class="inputs-group mb">
            <label class="input-container input-container-80">
              Nome do produto*
              <input name="name" value='<?php echo "{$array['DS_NOME']}"?>' type="text" />
            </label>
            <label class="input-container input-container-20">
              Código*
              <input name="codigo" value='<?php echo "{$array['DS_CODIGO']}"?>' type="text" />
            </label>
          </div>

          <div class="inputs-group">
            <label class="input-container input-container-40">
              Marca*
              <select name="marca" id="" required>
                <option value="0"></option>
                <?php
                  if($array['FK_MARCA'] == 1){
                    echo '<option value="1" selected>ToyShow</option>';
                  }else{
                    echo '<option value="1">ToyShow</option>';
                  }
                  foreach ($resultMA as $id => $reg){
                    if($array['FK_MARCA'] == $reg['PK_ID']){
                      echo "<option value='{$reg['PK_ID']}' selected>{$reg['DS_MARCA']}</option>";
                    }
                    else{
                      echo "<option value='{$reg['PK_ID']}'>{$reg['DS_MARCA']}</option>";
                    }
                  }
                ?>
              </select>
            </label>
            <label class="input-container input-container-40">
              Categoria*
              <select name="categoria" id="" required>
                <option value="0"></option>
                <?php
                    if($array['FK_CATEGORIA'] == 1){
                      echo '<option value="1" selected>Boneco</option>';
                    }else{
                      echo '<option value="1">Boneco</option>';
                    }
                  foreach ($resultCT as $id => $reg){
                    if($array['FK_CATEGORIA'] == $reg['PK_ID']){
                      echo "<option value='{$reg['PK_ID']}' selected>{$reg['DS_CATEGORIA']}</option>";
                    }
                    else{
                      echo "<option value='{$reg['PK_ID']}'>{$reg['DS_CATEGORIA']}</option>";
                    }
                  }
                ?>
              </select>
            </label>
          </div>

          <div class="inputs-group">
            <label class="input-container input-container-25">
              Preço venda
              <input value='<?php echo "{$array['VL_VENDA']}"?>' name="preco-venda" type="number" />
            </label>
            <label class="input-container input-container-25">
              Preço custo
              <input name="preco-custo" value='<?php echo "{$array['VL_CUSTO']}"?>' type="number" />
            </label>
            <label class="input-container input-container-25">
              Estoque mínimo
              <input name="estoque-minimo" value='<?php echo "{$array['QT_ESTOQUEMIN']}"?>' type="number" />
            </label>
            <label class="input-container input-container-25">
              Estoque atual
              <input name="estoque-atual" value='<?php echo "{$array['QT_ESTOQUEATUAL']}"?>' type="number" />
            </label>
          </div>

          <label class="input-container">
            Descrição
            <textarea name="descricao" id="" cols="30" rows="10"><?php echo "{$array['DS_DESCRICAO']}"?></textarea>
          </label>

          <input type="hidden" name='pk_id' value='<?php echo "{$array['PK_SKU']}" ?>'>
          <label class="checkbox-container mt mb">
            <input name="inativo" type="checkbox" name="" id="" />
            Inativo
          </label>

          <button class="blue-button mr" type="submit">Salvar</button>
          <button class="white-button" type="button">Limpar</button>

        </form>
      </section>
    </main>
  </body>
</html>
