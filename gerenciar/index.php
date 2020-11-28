<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Página Inicial</title>

    <!-- Css -->
    <link rel="stylesheet" href="../src/admin/css/styles.css">
    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Flaticon -->
    <link rel="shortcut icon" href="../src/admin/images/icon.png" />
    <!-- Js -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Bootstrap Js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Fontawesome icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Font-Family -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">

</head>

<body>
    <?php
        include_once 'login/validlogin.php';
    ?>

    <section class="section-general">
        <div class="menu-top">
            <h1>CALENDÁRIO ASTRONÔMICO</h1>
            <h3>Administrativo</h3>

            <div class="menu-user">
                <img src="../src/admin/images/astronaut.svg" alt="astronaut">
                <span><?= $_SESSION['nome'] ?></span>
                <a href="login/logoff.php">Sair</a>
            </div>
        </div>
        <div class="menu">

            <a class="menu-item col-md-4" href="galaxys.php" title="Gerenciar Galáxias">
                GALÁXIAS
            </a><br><br>

            <a class="menu-item col-md-4" href="systems.php" title="Gerenciar Sistemas Planetários">
                SISTEMAS
            </a><br><br>

            <a class="menu-item col-md-4" href="stars.php" title="Gerenciar Estrelas">
                ESTRELAS
            </a><br><br>

            <a class="menu-item col-md-4" href="planets.php" title="Gerenciar Planetas">
                PLANETAS
            </a><br><br>

            <a class="menu-item col-md-4" href="satellites.php" title="Gerenciar Satélites Naturais">
                SATÉLITES
            </a><br><br>

            <a class="menu-item col-md-4" href="comets.php" title="Gerenciar Cometas">
                COMETAS
            </a><br><br>

            <a class="menu-item col-md-4" href="phenomena.php" title="Gerenciar Fenômenos">
                FENÔMENOS
            </a><br><br>

            <a class="menu-item col-md-4" href="releases.php" title="Gerenciar Lançamentos">
                LANÇAMENTOS
            </a><br><br>

            <a class="menu-item col-md-4" href="missions.php" title="Gerenciar Missões">
                MISSÕES
            </a><br><br>
            
        </div>
    </section>
</body>

</html>