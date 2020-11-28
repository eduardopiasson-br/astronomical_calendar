<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrativo</title>

    <!-- Css -->
    <link rel="stylesheet" href="../../src/admin/css/styles.css">
    <!-- Flaticon -->
    <link rel="shortcut icon" href="../../src/admin/images/icon.png" />
    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Fontawesome icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Font-Family -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
</head>

<body>
    <?
    if(!empty($_POST['textLogin']) && !empty($_POST['textSenha'])) {
        // Capturando dados do formulário
        $login = $_POST['textLogin'];
        $senha = $_POST['textSenha'];

        // Criando o SQL para realizar a consulta
        include_once('../../config/conectar.php');

        // Executando a SQL query
        $query = "SELECT * FROM USERS WHERE USE_EMAIL = '$login' AND USE_PASSWORD = '$senha'";
        $res = mysqli_query($conexao, $query) or die ('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

        if($registro = mysqli_fetch_assoc($res)){
            // Cria sessão, uma vez que o login e senha conferem
            $nome = $registro['USE_NAME'];

            session_start();
            $_SESSION['login'] = $login;
            $_SESSION['nome'] = $nome;
            header("Location:../index.php");
        } else {
            // Login e senha não conferem
            echo("<center>Login Inválido.</center>");
        }
    }
    ?>

    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h2>FORMULÁRIO DE ACESSO</h2>
                </div>
                <div class="card-body">
                    <form method="post" name="formLogin" action="login.php">
                        <?
                            if (isset($_GET['erro'])) {
                                $erro = $_GET['erro'];
                                echo "<center>$erro</center>";
                            }
                        ?>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="textLogin" class="form-control" placeholder="e-mail">

                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="textSenha" class="form-control" placeholder="senha">
                        </div>
                        <div class="form-group">
                            <input type="submit" title="Acessar gerenciamento do sistema" value="Logar" class="input-btn btn float-center login_btn">
                            <input type="reset" title="Remover dados preenchidos" value="Limpar" class="input-btn btn float-center login_btn">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>