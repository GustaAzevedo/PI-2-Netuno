<?php include "../../../backend/functions/valida_user.php";?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Página de usuário</title>
    <script src="../assets/js/menu.js"></script>
    <link rel="stylesheet" href="../assets/styles/css/menu.css" />
    <link rel="stylesheet" href="../assets/styles/css/header.css" />
    <link rel="stylesheet" href="../assets/styles/css/main.css" />
    <link rel="stylesheet" href="../assets/styles/css/register-client.css">
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
                  <img class="title__icon" src="../assets/svgs/arrow-down.svg" alt="arrow down">
                </span>
                <ul class="item__subnav">
                  <li class="subnav__item">
                    <a class="item__link" href="../../../backend/clienteconsultar.php">Clientes</a>
                  </li>
                  <li class="subnav__item">
                    <a class="item__link" href="../../../backend/produtoconsultar.php">Produtos</a>
                  </li>
                  <li class="subnav__item">
                    <a class="item__link" href="../../../backend/usuarioconsultar.php">Usuários</a>
                  </li>
                </ul>
              </li>
              <li class="nav__item hide-children">
                <span class="item__title">
                  Mais
                  <img
                    class="title__icon"
                    src="../assets/svgs/arrow-down.svg"
                    alt="arrow down"
                  />
                </span>
                <ul class="item__subnav">
                  <li class="subnav__item">
                    <a class="item__link" href="../../../backend/logsconsultar.php">Logs</a>
                  </li>
                  <li class="subnav__item">
                    <a class="item__link" href="../../../backend/functions/logout.php">Logout</a>
                  </li>
                </ul>
              </li>
            </ul>
            <a href="./welcome.php">
              <img src="../assets/images/logo.png" alt="netuno">
            </a>
      </nav>
      <section class="main__page-content right-container">
        <div class="page-content__title">
          <h1 class="page-title mb">Clientes</h1>
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
        <form class="page-content__inputs mb" method='POST' action='../../../backend/clientedigitar.php'>
          <div class="inputs-group mb">
            <label class="input-container input-container-40">
              Fantasia*
              <input name="fantasia" type="text" required/>
            </label>
            <label class="input-container input-container-60">
              Razão Social*
              <input name="razao" type="text" required/>
            </label>
          </div>

          <div class="inputs-group ">
            <label class="input-container input-container-10">
              Pessoa*
              <select name="pessoa" id="" required>
                <option value="F">F</option>
                <option value="J">J</option>
              </select>
            </label>
            <label class="input-container input-container-45">
              CPF/CNPJ*
              <input name="cpf" type="number" required/>
            </label>
            <label class="input-container input-container-45">
              E-mail*
              <input name="email" type="email" required/>
            </label>
          </div>

          <div class="inputs-group">
            <label class="input-container input-container-50">
              Telefone
              <input name="telefone" type="tel" pattern="[0-9]+" max='10'placeholder="99 99999999"/>
            </label>
            <label class="input-container input-container-50">
              Celular
              <input name="celular" type="tel"pattern="[0-9]+" max='11' placeholder="99 999999999"/>
            </label>
          </div>

          <hr class="divider"/>

          <div class="inputs-group">
            <label class="input-container input-container-40">
              CEP*
              <input name="cep" type="number" max='99999999' required/>
            </label>
            <label class="input-container input-container-60">
              Endereço*
              <input name="endereco" type="text" required/>
            </label>
          </div>

          <div class="inputs-group">
            <label class="input-container input-container-10">
              Número*
              <input name="numero" type="text" required/>
            </label>
            <label class="input-container input-container-10">
              Estado*
              <select name="estado" id="" required>
              <option value=""></option>
                <option value="AC">AC</option>
                <option value="AL">AL</option>
                <option value="AM">AM</option>
                <option value="AP">AP</option>
                <option value="BA">BA</option>
                <option value="CE">CE</option>
                <option value="DF">DF</option>
                <option value="ES">ES</option>
                <option value="GO">GO</option>
                <option value="MA">MA</option>
                <option value="MG">MG</option>
                <option value="MS">MS</option>
                <option value="MT">MT</option>
                <option value="PA">PA</option>
                <option value="PB">PB</option>
                <option value="PE">PE</option>
                <option value="PI">PI</option>
                <option value="PR">PR</option>
                <option value="RJ">RJ</option>
                <option value="RN">RN</option>
                <option value="RO">RO</option>
                <option value="RR">RR</option>
                <option value="RS">RS</option>
                <option value="SC">SC</option>
                <option value="SE">SE</option>
                <option value="SP">SP</option>
                <option value="TO">TO</option>
              </select>
            </label>
            <label class="input-container input-container-80">
              Cidade*
              <input name="cidade" type="text" required/>
            </label>
          </div>

          <div class="inputs-group">
            <label class="input-container input-container-50">
              Complemento
              <input name="complemento" type="text" />
            </label>
            <label class="input-container input-container-50">
              Refêrencia
              <input name="referencia" type="text" />
            </label>
          </div>

          <label class="input-container">
            Observação
            <textarea name="observacao" id="" cols="30" rows="10"></textarea>
          </label>

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
