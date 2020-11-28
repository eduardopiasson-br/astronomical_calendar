<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sair</title>
</head>
<body>
    <?

    session_start();
    session_unset();
    session_destroy();

    header("Location:login.php");

    ?>
</body>
</html>