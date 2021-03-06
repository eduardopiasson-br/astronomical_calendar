<!DOCTYPE html>
<html lang="pr-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistemas | Calendário Astronômico</title>

        <!-- Css -->
	<link rel="stylesheet" href="../src/project/css/styles.css">
	<link rel="stylesheet" href="../src/project/css/responsive.css">
	<!-- Bootstrap Css -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<!-- Flaticon -->
	<link rel="shortcut icon" href="../src/project/images/icon.png" />
	<!-- Fontawesome icons -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<!-- Font-Family -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
</head>
<body>

	<!-- Conexão e busca de dados no banco -->
    <?php
        ini_set('default_charset', 'UTF-8');

        error_reporting(0);
        include_once("../config/conectar.php");

        $query = 'SELECT * FROM GENERIC INNER JOIN SYSTEMS ON GENERIC.GEN_CODE = SYSTEMS.SYS_GEN_CODE;';
        $sql_info = mysqli_query($conexao, $query) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
    ?>

	<!-- Seçao de menu -->
    <section class="col-md-12 col-sm-12 top-menu">

		<!-- Divs menu e de recarga -->
        <div class="col-md-11 col-sm-11 title-menu">
            <a class="button-calendar" href="index.php" title="Ir para o calendário"> <i class="fas fa-calendar"></i> Calendário</a>
			<h1>Calendário Astronômico - <span>Sistemas</span</h1>
		</div>
		<div class="col-md-1 col-sm-1 menu-menu">
			<div class="dropdown">
				<button class="dropbtn"><i class="fas fa-caret-square-down"></i></button>
				<div class="dropdown-content">
					<a href="galaxys.php">Galáxias</a>
					<a href="systems.php">Sistemas</a>
					<a href="stars.php">Estrelas</a>
					<a href="planets.php">Planetas</a>
					<a href="satellites.php">Satelites</a>
					<a href="comets.php">Cometas</a>
					<a href="phenomena.php">Fenomenos</a>
					<a href="missions.php">Missões</a>
					<a href="releases.php">Lançamentos</a>
				</div>
			</div>
		</div>
    </section>

	<!-- Section principal onde são exibidos os dados -->
    <section class="col-md-12">
        <div class="col-md-12">
			<div class="col-md-12 col-sm-12 div-infos top-infos desktop">
				<div class="col-md-3"> Nome <br> Qtd. Planetas</div>
				<div class="col-md-3"> Descrição <br> do Sistema</div>
                <div class="col-md-4"> Distância da Terra - Massa <br> Diâmetro - Espessura</div>
                <div class="col-md-2"> Galáxia Pertencente </div>
			</div>
			<?php while ($dado = mysqli_fetch_assoc($sql_info)) : ?>
				<!-- Informação Desktop -->
				<div class="col-md-12 col-sm-12 div-infos infos desktop">
					<div class="col-md-3">
						<p><?php echo $dado['GEN_NAME'] ?> - <?php echo $dado['SYS_PLANETS'] ?></p>
					</div>
					<div class="col-md-3 description-info"><p><?php echo $dado['GEN_DESCRIPTION'] ?></p></div>
					<div class="col-md-4">
                        <p><?php echo $dado['GEN_DISTANCE'] ?> Kms - <?php echo $dado['GEN_MASS'] ?> - <?php echo $dado['SYS_DIAMETER'] ?> UA - <?php echo $dado['SYS_THICKNESS'] ?> UA</p>
                    </div>
                    <div class="col-md-2">

						<!-- Carregamento de elemento de tabéla associada -->
                        <?php 
                            $code =  $dado['SYS_GAL_CODE'];
                            $query2 = "SELECT GAL_GEN_CODE FROM GALAXYS WHERE GALAXYS.GAL_CODE = '$code';";
                            $sql_associated = mysqli_query($conexao, $query2) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $assoc = mysqli_fetch_array($sql_associated);
                            $associa = $assoc['GAL_GEN_CODE'];

                            $query3 = "SELECT GEN_NAME FROM GENERIC WHERE GENERIC.GEN_CODE = '$associa;'";
                            $sql_gen = mysqli_query($conexao, $query3) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $associated = mysqli_fetch_array($sql_gen);
                        ?>
                        <p>
                            <?php echo $associated['GEN_NAME'] ?>
                        </p>
                    </div>
				</div>

				<!-- Informaçao Mobile -->
				<div class="col-md-12 col-sm-12 div-infos infos mobile">
					<div>
						<span>Nome: </span><p><?php echo $dado['GEN_NAME'] ?></p>
					</div>
					<div>
						<span>Qtd. Planetas: </span><p><?php echo $dado['SYS_PLANETS'] ?></p>
					</div>
					<div>
						<span>Descrição: </span><p><?php echo $dado['GEN_DESCRIPTION'] ?></p>
					</div>
					<div>
						<span>Distância da Terra: </span><p><?php echo $dado['GEN_DISTANCE'] ?></p>
					</div>
					<div>
						<span>Massa: </span><p><?php echo $dado['GEN_MASS'] ?></p>
					</div>
					<div>
						<span>Diâmetro: </span><p><?php echo $dado['SYS_DIAMETER'] ?></p>
					</div>
					<div>
						<span>Espessura: </span><p><?php echo $dado['SYS_THICKNESS'] ?></p>
					</div>
					<div>
						<span>Galáxia Pertencente: </span><p><?php echo $associated['GEN_NAME'] ?></p>
					</div>
				</div>
            <?php endwhile; ?>
        </div>
    </section>
    
</body>
</html>