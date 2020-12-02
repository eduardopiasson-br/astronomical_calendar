<!DOCTYPE html>
<html lang="pr-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Missões | Calendário Astronômico</title>

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

        $query = 'SELECT * FROM MISSIONS ORDER BY MISSIONS.MIS_DATE DESC;';
        $sql_info = mysqli_query($conexao, $query) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
    ?>

	<!-- Seçao de menu -->
    <section class="col-md-12 col-sm-12 top-menu">

        <!-- Divs menu e de recarga -->
        <div class="col-md-11 col-sm-11 title-menu">
            <a class="button-calendar" href="index.php" title="Ir para o calendário"> <i class="fas fa-calendar"></i> Calendário</a>
			<h1>Calendário Astronômico - <span>Missões</span</h1>
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
				<div class="col-md-2"> Nome <br> Companhia</div>
				<div class="col-md-3"> Descrição <br> da Missão</div>
				<div class="col-md-2"> Origem <br> Destino</div>
                <div class="col-md-2"> Objetivo <br> Data</div>
                <div class="col-md-3"> Associações</div>
			</div>
            <?php while ($dado = mysqli_fetch_assoc($sql_info)) : ?>
                <!-- Informação Desktop -->
				<div class="col-md-12 col-sm-12 div-infos infos desktop">
					<div class="col-md-2">
						<p><?php echo $dado['MIS_NAME'] ?><br><?php echo $dado['MIS_COMPANY'] ?></p>
					</div>
					<div class="col-md-3 description-info"><p><?php echo $dado['MIS_DESCRIPTION'] ?></p></div>
                    <div class="col-md-2"><p><?php echo $dado['MIS_LOCAL'] ?><br><?php echo $dado['MIS_DESTINY'] ?></p></div>
                    <div class="col-md-2"><p><?php echo $dado['MIS_OBJECTIVE'] ?><br><?php echo $dado['MIS_DATE'] ?></p></div>
                    <div class="col-md-3">
                        <?php 
                        // Verifica se a missão está associado a uma galáxia e traz o Nome da galáxia associada
                            $code =  $dado['MIS_CODE'];
                            $query2 = "SELECT MIG_GAL_CODE FROM MISSIONS_GALAXYS WHERE MISSIONS_GALAXYS.MIG_MIS_CODE = '$code';";
                            $sql_associated = mysqli_query($conexao, $query2) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $assoc = mysqli_fetch_array($sql_associated); $associa1 = $assoc['MIG_GAL_CODE'];
                            $query3 = "SELECT GAL_GEN_CODE FROM GALAXYS WHERE GALAXYS.GAL_CODE = '$associa1;'";
                            $sql_associated2 = mysqli_query($conexao, $query3) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $associated2 = mysqli_fetch_array($sql_associated2); $associa2 = $associated2['GAL_GEN_CODE'];
                            $query3 = "SELECT GEN_NAME FROM GENERIC WHERE GENERIC.GEN_CODE = '$associa2;'";
                            $sql_gen = mysqli_query($conexao, $query3) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $associated1 = mysqli_fetch_array($sql_gen);
                        ?>
                        <p>
                            <?php echo $associated1['GEN_NAME'] ?>
                        </p>

                        <?php 
                        // Verifica se a missão está associado a um sistema e traz o Nome do sistema associado
                            $query2 = "SELECT MSY_SYS_CODE FROM MISSIONS_SYSTEMS WHERE MISSIONS_SYSTEMS.MSY_MIS_CODE = '$code';";
                            $sql_associated = mysqli_query($conexao, $query2) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $assoc = mysqli_fetch_array($sql_associated); $associa1 = $assoc['MSY_SYS_CODE'];
                            $query3 = "SELECT SYS_GEN_CODE FROM SYSTEMS WHERE SYSTEMS.SYS_CODE = '$associa1;'";
                            $sql_associated2 = mysqli_query($conexao, $query3) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $associated2 = mysqli_fetch_array($sql_associated2); $associa2 = $associated2['SYS_GEN_CODE'];
                            $query3 = "SELECT GEN_NAME FROM GENERIC WHERE GENERIC.GEN_CODE = '$associa2;'";
                            $sql_gen = mysqli_query($conexao, $query3) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $associated2 = mysqli_fetch_array($sql_gen);
                        ?>
                        <p>
                            <?php echo $associated2['GEN_NAME'] ?>
                        </p>

                        <?php 
                        // Verifica se a missão está associado a uma estrela e traz o Nome da estrela associadas
                            $query2 = "SELECT MST_STA_CODE FROM MISSIONS_STARS WHERE MISSIONS_STARS.MST_MIS_CODE = '$code';";
                            $sql_associated = mysqli_query($conexao, $query2) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $assoc = mysqli_fetch_array($sql_associated); $associa1 = $assoc['MST_STA_CODE'];
                            $query3 = "SELECT STA_GEN_CODE FROM STARS WHERE STARS.STA_CODE = '$associa1;'";
                            $sql_associated2 = mysqli_query($conexao, $query3) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $associated2 = mysqli_fetch_array($sql_associated2); $associa2 = $associated2['STA_GEN_CODE'];
                            $query3 = "SELECT GEN_NAME FROM GENERIC WHERE GENERIC.GEN_CODE = '$associa2;'";
                            $sql_gen = mysqli_query($conexao, $query3) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $associated3 = mysqli_fetch_array($sql_gen);
                        ?>
                        <p>
                            <?php echo $associated3['GEN_NAME'] ?>
                        </p>

                        <?php 
                        // Verifica se a missão está associado a um planeta e traz o Nome do planeta associado
                            $query2 = "SELECT MIP_PLA_CODE FROM MISSIONS_PLANETS WHERE MISSIONS_PLANETS.MIP_MIS_CODE = '$code';";
                            $sql_associated = mysqli_query($conexao, $query2) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $assoc = mysqli_fetch_array($sql_associated); $associa1 = $assoc['MIP_PLA_CODE'];
                            $query3 = "SELECT PLA_GEN_CODE FROM PLANETS WHERE PLANETS.PLA_CODE = '$associa1;'";
                            $sql_associated2 = mysqli_query($conexao, $query3) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $associated2 = mysqli_fetch_array($sql_associated2); $associa2 = $associated2['PLA_GEN_CODE'];
                            $query3 = "SELECT GEN_NAME FROM GENERIC WHERE GENERIC.GEN_CODE = '$associa2;'";
                            $sql_gen = mysqli_query($conexao, $query3) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $associated4 = mysqli_fetch_array($sql_gen);
                        ?>
                        <p>
                            <?php echo $associated4['GEN_NAME'] ?>
                        </p>

                        <?php 
                        // Verifica se a missão está associado a um satelite e traz o Nome do satelite associado
                            $query2 = "SELECT MSA_SAT_CODE FROM MISSIONS_SATELLITES WHERE MISSIONS_SATELLITES.MSA_MIS_CODE = '$code';";
                            $sql_associated = mysqli_query($conexao, $query2) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $assoc = mysqli_fetch_array($sql_associated); $associa1 = $assoc['MSA_SAT_CODE'];
                            $query3 = "SELECT SAT_GEN_CODE FROM SATELLITES WHERE SATELLITES.SAT_CODE = '$associa1;'";
                            $sql_associated2 = mysqli_query($conexao, $query3) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $associated2 = mysqli_fetch_array($sql_associated2); $associa2 = $associated2['SAT_GEN_CODE'];
                            $query3 = "SELECT GEN_NAME FROM GENERIC WHERE GENERIC.GEN_CODE = '$associa2;'";
                            $sql_gen = mysqli_query($conexao, $query3) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $associated5 = mysqli_fetch_array($sql_gen);
                        ?>
                        <p>
                            <?php echo $associated5['GEN_NAME'] ?>
                        </p>

                        <?php 
                        // Verifica se a missão está associado a um cometa e traz o Nome do cometa associado
                            $query2 = "SELECT MIC_COM_CODE FROM MISSIONS_COMETS WHERE MISSIONS_COMETS.MIC_MIS_CODE = '$code';";
                            $sql_associated = mysqli_query($conexao, $query2) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $assoc = mysqli_fetch_array($sql_associated); $associa1 = $assoc['MIC_COM_CODE'];
                            $query3 = "SELECT COM_GEN_CODE FROM COMETS WHERE COMETS.COM_CODE = '$associa1;'";
                            $sql_associated2 = mysqli_query($conexao, $query3) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $associated2 = mysqli_fetch_array($sql_associated2); $associa2 = $associated2['COM_GEN_CODE'];
                            $query3 = "SELECT GEN_NAME FROM GENERIC WHERE GENERIC.GEN_CODE = '$associa2;'";
                            $sql_gen = mysqli_query($conexao, $query3) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                            $associated6 = mysqli_fetch_array($sql_gen);
                        ?>
                        <p>
                            <?php echo $associated6['GEN_NAME'] ?>
                        </p>
                    </div>
                </div>
                <!-- Informação Mobile -->
                <div class="col-md-12 col-sm-12 div-infos infos mobile">
					<div>
						<span>Nome: </span><p><?php echo $dado['MIS_NAME'] ?></p>
					</div>
					<div>
						<span>Companhia: </span><p><?php echo $dado['MIS_COMPANY'] ?></p>
                    </div>
                    <div>
						<span>Descrição: </span><p><?php echo $dado['MIS_DESCRIPTION'] ?></p>
					</div>
					<div>
						<span>Origem: </span><p><?php echo $dado['MIS_LOCAL'] ?></p>
					</div>
					<div>
						<span>Destino: </span><p><?php echo $dado['MIS_DESTINY'] ?></p>
					</div>
					<div>
						<span>Objetivo: </span><p><?php echo $dado['MIS_OBJECTIVE'] ?></p>
					</div>
					<div>
						<span>Data: </span><p><?php echo $dado['MIS_DATE'] ?></p>
					</div>
					<div>
                        <span>Associateds: </span>
                        <p>
                            <? if(!empty($associated1['GEN_NAME'])) { ?><?php echo $associated1['GEN_NAME'] ?><? } ?><br>
                            <? if(!empty($associated2['GEN_NAME'])) { ?><?php echo $associated2['GEN_NAME'] ?><? } ?><br>
                            <? if(!empty($associated3['GEN_NAME'])) { ?><?php echo $associated3['GEN_NAME'] ?><? } ?><br>
                            <? if(!empty($associated4['GEN_NAME'])) { ?><?php echo $associated4['GEN_NAME'] ?><? } ?><br>
                            <? if(!empty($associated5['GEN_NAME'])) { ?><?php echo $associated5['GEN_NAME'] ?><? } ?><br>
                            <? if(!empty($associated6['GEN_NAME'])) { ?><?php echo $associated6['GEN_NAME'] ?><? } ?><br>
                        </p>
					</div>
				</div>
            <?php endwhile; ?>
        </div>
    </section>
    
</body>
</html>