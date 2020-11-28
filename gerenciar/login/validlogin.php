<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?
        session_start();
        if(!isset($_SESSION["login"])) {
            //Se a variável de sessão não existe, significa que o usuário não foi autenticado,
            //portanto deve ser redirecionado para a página de login
            header("Location:login/login.php");
        }
    ?>
</body>
</html>