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
              <img
                class="title__icon"
                src="../assets/svgs/arrow-down.svg"
                alt="arrow down"
              />
            </span>
            <ul class="item__subnav">
              <li class="subnav__item">
                <a class="item__link" href="../../../backend/register-client.php">Clientes</a>
              </li>
              <li class="subnav__item">
                <a class="item__link" href="/">Produtos</a>
              </li>
              <li class="subnav__item">
                <a class="item__link" href="../../../backend/usuarioconsultar.php">Usuários</a>
              </li>
            </ul>
          </li>
          <li class="nav__item hide-children">
            <span class="item__title">
              Cadastros
              <img
                class="title__icon"
                src="../assets/svgs/arrow-down.svg"
                alt="arrow down"
              />
            </span>
            <ul class="item__subnav">
              <li class="subnav__item">
                <a class="item__link" href="../../../backend/register-client.php">Clientes</a>
              </li>
              <li class="subnav__item">
                <a class="item__link" href="/">Produtos</a>
              </li>
              <li class="subnav__item">
                <a class="item__link" href="../../../backend/usuarioconsultar.php">Usuários</a>
              </li>
            </ul>
          </li>
        </ul>
        <img src="../assets/images/logo.png" alt="netuno" />
      </nav>
      <section class="main__page-content right-container">
        <div class="page-content__title">
          <h1 class="page-title mb">Clientes</h1>
        </div>
        <form class="page-content__inputs mb">
          <div class="inputs-group mb">
            <label class="input-container input-container-40">
              Fantasia*
              <input name="fantasia" type="text" />
            </label>
            <label class="input-container input-container-60">
              Razão Social*
              <input name="razao" type="email" />
            </label>
          </div>

          <div class="inputs-group ">
            <label class="input-container input-container-10">
              Pessoa*
              <select name="pessoa" id=""></select>
            </label>
            <label class="input-container input-container-45">
              CPF/CNPJ*
              <input name="cpf" type="number" />
            </label>
            <label class="input-container input-container-45">
              E-mail*
              <input name="email" type="email" />
            </label>
          </div>

          <div class="inputs-group">
            <label class="input-container input-container-50">
              Telefone
              <input name="telefone" type="number" />
            </label>
            <label class="input-container input-container-50">
              Celular
              <input name="celular" type="number" />
            </label>
          </div>

          <hr class="divider"/>

          <div class="inputs-group">
            <label class="input-container input-container-40">
              CEP*
              <input name="cep" type="number" />
            </label>
            <label class="input-container input-container-60">
              Endereço*
              <input name="endereco" type="text" />
            </label>
          </div>

          <div class="inputs-group">
            <label class="input-container input-container-10">
              Número*
              <input name="numero" type="number" />
            </label>
            <label class="input-container input-container-10">
              Estado*
              <select name="estado" id=""></select>
            </label>
            <label class="input-container input-container-80">
              Cidade*
              <input name="cidade" type="text" />
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
