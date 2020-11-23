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
                <a class="item__link" href="/">Produtos</a>
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
                <a class="item__link" href="#">Logs</a>
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
          <h1 class="page-title mb">Clientes(Alterar)</h1>
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
        <form class="page-content__inputs mb" method='POST' action='../backend/clientealterar.php'>
          <div class="inputs-group mb">
            <label class="input-container input-container-40">
              Fantasia*
              <input name="fantasia" type="text" value='<?php echo "{$array['DS_FANTASIA']}"?>' required/>
            </label>
            <label class="input-container input-container-60">
              Razão Social*
              <input name="razao" type="text" value='<?php echo "{$array['DS_RAZAO']}"?>' required/>
            </label>
          </div>

          <div class="inputs-group ">
            <label class="input-container input-container-10">
              Pessoa*
              <select name="pessoa" id=""  required>
                <?php
                  if($array['TG_PESSOA'] == 'F'){
                     echo '<option value="F" selected>F</option>
                           <option value="J">J</option>'; 
                  }else{
                    echo '<option value="F">F</option>
                           <option value="J" selected>J</option>'; 
                  }
                ?>
                
              </select>
            </label>
            <label class="input-container input-container-45">
              CPF/CNPJ*
              <input name="cpf" type="number" value='<?php echo "{$array['NR_CPF']}"?>' required/>
            </label>
            <label class="input-container input-container-45">
              E-mail*
              <input name="email" type="email" value='<?php echo "{$array['DS_EMAIL']}"?>' required/>
            </label>
          </div>

          <div class="inputs-group">
            <label class="input-container input-container-50">
              Telefone
              <input name="telefone" value='<?php echo "{$array['DS_TELEFONE']}"?>' type="tel" pattern="[0-9]+" max='10'placeholder="99 99999999"/>
            </label>
            <label class="input-container input-container-50">
              Celular
              <input name="celular" value='<?php echo "{$array['DS_CELULAR']}"?>' type="tel"pattern="[0-9]+" max='11' placeholder="99 999999999"/>
            </label>
          </div>

          <hr class="divider"/>

          <div class="inputs-group">
            <label class="input-container input-container-40">
              CEP*
              <input name="cep" value='<?php echo "{$array['DS_CEP']}"?>' type="number" max='99999999' required/>
            </label>
            <label class="input-container input-container-60">
              Endereço*
              <input name="endereco" value='<?php echo "{$array['DS_ENDERECO']}"?>' type="text" required/>
            </label>
          </div>

          <div class="inputs-group">
            <label class="input-container input-container-10">
              Número*
              <input name="numero" value='<?php echo "{$array['DS_NUMERO']}"?>' type="text" required/>
            </label>
            <label class="input-container input-container-10">
              Estado*
              <select name="estado" id="" required>
                <option value=""></option>
                <?php
                  if($array['FK_ESTADO'] =='AC'){
                    echo '<option value="AC" selected>AC</option>';
                  }else{
                    echo '<option value="AC">AC</option>';
                  }
                  foreach ($resultES as $id => $reg){
                    if($array['FK_ESTADO'] == $reg['PK_ID']){
                      echo "<option value='{$reg['PK_ID']}' selected>{$reg['PK_ID']}</option>";
                    }
                    else{
                      echo "<option value='{$reg['PK_ID']}'>{$reg['PK_ID']}</option>";
                    }
                  }
                ?>
              </select>
            </label>
            <label class="input-container input-container-80">
              Cidade*
              <input name="cidade" type="text" value='<?php echo "{$array['DS_CIDADE']}"?>' required/>
            </label>
          </div>

          <div class="inputs-group">
            <label class="input-container input-container-50">
              Complemento
              <input name="complemento" value='<?php echo "{$array['DS_COMPLEMENTO']}"?>' type="text" />
            </label>
            <label class="input-container input-container-50">
              Refêrencia
              <input name="referencia" type="text" value='<?php echo "{$array['DS_REFERENCIA']}"?>'/>
            </label>
          </div>

          <label class="input-container">
            Observação
            <textarea name="observacao" id="" cols="30" rows="10" ><?php echo "{$array['DS_OBSERVACAO']}"?></textarea>
          </label>
          <input type="hidden" name='pk_id' value='<?php echo "{$array['PK_ID']}" ?>'>
          <label class="checkbox-container mt mb">
            <input name="inativo" type="checkbox" name="" id="" />
            Inativo
          </label>

          <button class="blue-button mr" type="submit">Salvar</button>
          <button class="white-button" type="reset">Limpar</button>


        </form>
      </section>
    </main>
  </body>
</html>
