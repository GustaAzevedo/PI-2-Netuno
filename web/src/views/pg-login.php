<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/css/pg-login.css">
    <link href="https://fonts.googleapis.com/css2?family=Rhodium+Libre&display=swap" rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <header>
        <nav class=" bg-blue">
        </nav>
        <div class=" bg-yellow">
        </div>

    </header>

    <body>
        <div class=" container">
            <div class="container-form">
                <div class=" logo">
                    <img src="../assets/images/logo.png" alt="logo">
                </div>
                <div class="invalido">
                    <p>Login ou senha inválidos!</p>
                </div>
                <form class=" form" method="POST" action="../../../backend/login.php">
                    <fieldset>
                        <div class=" input">
                            <label class=" d-block" for="usuario">Login</label>
                            <input class=" d-block" type="text" name="login" id="usuario">
                        </div>
                        <div class=" input">
                            <label class=" d-block" for="password">Senha</label>
                            <input class=" d-block" type="password" name="senha" id="password">
                        </div>
                        <span class=" d-block"><a href="./">Esqueci a senha</a></span>
                        <!-- colocar o link da página esqueci a senha quando tiver -->
                        <div class=" button">
                            <input class=" btn" type="submit" value="Entrar">
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </body>

    <footer>

    </footer>

</body>

</html>