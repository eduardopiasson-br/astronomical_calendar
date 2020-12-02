<!DOCTYPE html>
<html lang="pr-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lançamentos | Calendário Astronômico</title>

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

        $query = 'SELECT * FROM RELEASES ORDER BY RELEASES.REL_DATE DESC;';
        $sql_info = mysqli_query($conexao, $query) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
    ?>

	<!-- Seçao de menu -->
    <section class="col-md-12 col-sm-12 top-menu">

		<!-- Divs menu e de recarga -->
        <div class="col-md-11 col-sm-11 title-menu">
            <a class="button-calendar" href="index.php" title="Ir para o calendário"> <i class="fas fa-calendar"></i> Calendário</a>
			<h1>Calendário Astronômico - <span>Lançamentos</span</h1>
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
				<div class="col-md-2"> Nome <br> Data</div>
				<div class="col-md-2"> Companhia</div>
				<div class="col-md-3"> Descrição <br> da Missão</div>
				<div class="col-md-2"> Origem <br> Destino</div>
                <div class="col-md-3"> Associações</div>
			</div>
			<?php while ($dado = mysqli_fetch_assoc($sql_info)) : ?>
				<!-- Informação Desktop -->
				<div class="col-md-12 col-sm-12 div-infos infos desktop">
					<div class="col-md-2"><p><?php echo $dado['REL_NAME'] ?><br><?php echo $dado['REL_DATE'] ?></p></div>
					<div class="col-md-2"><p><?php echo $dado['REL_COMPANY'] ?></p></div>
					<div class="col-md-3 description-info"><p><?php echo $dado['REL_DESCRIPTION'] ?></p></div>
                    <div class="col-md-2"><p><?php echo $dado['REL_LOCAL'] ?><br><?php echo $dado['REL_DESTINY'] ?></p></div>
                    <div class="col-md-3">
                        <?php 
                        // Verifica se o lançamento está associado a um fenômeno e traz o Nome do fenômeno associado
						$code =  $dado['REL_CODE'];
                            $query2 = "SELECT REP_PHE_CODE FROM RELEASE_PHENOMENA WHERE RELEASE_PHENOMENA.REP_REL_CODE = '$code';";
                            $sql_associated = mysqli_query($conexao, $query2) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $assoc = mysqli_fetch_array($sql_associated); $associa1 = $assoc['REP_PHE_CODE'];
                            $query3 = "SELECT PHE_NAME FROM PHENOMENA WHERE PHENOMENA.PHE_CODE = '$associa1;'";
                            $sql_associated2 = mysqli_query($conexao, $query3) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $associated1 = mysqli_fetch_array($sql_associated2);
                        ?>
                        <p>
                            <?php echo $associated1['PHE_NAME'] ?>
                        </p>

                        <?php 
                        // Verifica se o lançamento está associado a uma missão e traz o Nome da missão associada
						$query2 = "SELECT REM_MIS_CODE FROM RELEASE_MISSION WHERE RELEASE_MISSION.REM_REL_CODE = '$code';";
						$sql_associated = mysqli_query($conexao, $query2) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
						$assoc = mysqli_fetch_array($sql_associated); $associa1 = $assoc['REM_MIS_CODE'];
						$query3 = "SELECT MIS_NAME FROM MISSIONS WHERE MISSIONS.MIS_CODE = '$associa1;'";
						$sql_associated2 = mysqli_query($conexao, $query3) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
						$associated2 = mysqli_fetch_array($sql_associated2);
					?>
					<p>
						<?php echo $associated2['MIS_NAME'] ?>
					</p>

                    </div>
				</div>
				<!-- Informaçao Mobile -->
				<div class="col-md-12 col-sm-12 div-infos infos mobile">
					<div>
						<span>Nome: </span><p><?php echo $dado['REL_NAME'] ?></p>
					</div>
					<div>
						<span>Data: </span><p><?php echo $dado['REL_DATE'] ?></p>
					</div>
					<div>
						<span>Descrição: </span><p><?php echo $dado['REL_DESCRIPTION'] ?></p>
					</div>
					<div>
						<span>Companhia: </span><p><?php echo $dado['REL_COMPANY'] ?></p>
					</div>
					<div>
						<span>Origem: </span><p><?php echo $dado['REL_LOCAL'] ?></p>
					</div>
					<div>
						<span>Destino: </span><p><?php echo $dado['REL_DESTINY'] ?></p>
					</div>
					<div>
						<span>Associações: </span>
						<p>
							<?php echo $associated1['PHE_NAME'] ?><br>
							<?php echo $associated2['MIS_NAME'] ?><br>
						</p>
					</div>
				</div>
            <?php endwhile; ?>
        </div>
    </section>
    
</body>
</html>