<?php

// Verifica se foi passada uma data senão traz a data corrente
if (isset($_POST['date'])) {
	$date = $_POST['DATE'];
	$new_date = explode("-", $date);

	$year = $new_date[0];
	$month = $new_date[1];
	$day = $new_date[2];
} else {
	$year = date('Y');
	$month = date('m');
	$day = date('d');
};

// Caso o utilizador clique em algum dia do calendário mensal
if (isset($_GET['dia'])) {
	$day = $_GET['dia'];
}

// Função que gera os dias da semana
function MostreSemanas()
{
	$weeks = array(
		"Dom",
		"Seg",
		"Ter",
		"Qua",
		"Qui",
		"Sex",
		"Sab"
	);

	for ($i = 0; $i < 7; $i++)
		echo "<th>" . $weeks{$i} . "</th>";
}

function GetNumeroDias($month = NULL, $year = NULL)
{
	$num_days = array(
		'01' => 31, '02' => 28, '03' => 31, '04' => 30, '05' => 31, '06' => 30,
		'07' => 31, '08' => 31, '09' => 30, '10' => 31, '11' => 30, '12' => 31
	);

	if ((($year % 4) == 0 and ($year % 100) != 0) or ($year % 400) == 0) {
		$num_days['02'] = 29;	// altera o numero de dias de fevereiro se o ano for bissexto
	}

	return $num_days[$month];
}

// função que carrega o calendário conforme a data passada pelo utilizador
function MostreCalendario($day = NULL, $month = NULL, $year = NULL, $conexao)
{
	$num_days = GetNumeroDias($month, $year);	// retorna o numero de dias que tem o mes
	$current_day = 0;

	// função para descobrir o dia da semana 
	$day_week = jddayofweek(cal_to_jd(CAL_GREGORIAN, $month, '01', $year), 0);

	// abertura da table para formar o calendário
	echo "<table>";

	echo "<tr class='day-name'>";
	// Chamada da função para buscar as semanas
	MostreSemanas();	

	// Código que gera o calendário
	echo "</tr>";
	for ($line = 0; $line < 6; $line++) {

		echo "<tr>";

		for ($column = 0; $column < 7; $column++) {
			echo "<td class='day' ";

			if (($current_day == ($day - 1) && $month == $month)) {
				echo " id='today' ";
			} else {
				if (($current_day + 1) <= $num_days) {
					if ($column < $day_week && $line == 0) {
						echo " id = 'number' ";
					} else {
						echo " id = 'number' ";
					}
				} else {
					echo " ";
				}
			}
			echo " >";

			// Nessa parte do código é onde cada dia é tratado, onde também são realizadas as buscas de existência de eventos para adicionar os marcadores nas datas referentes
			if ($current_day + 1 <= $num_days) {
				if ($column < $day_week && $line == 0) {
					echo " ";
				} else {
					error_reporting(0);
					$day_select = $current_day + 1;
					$query_phenomena = "SELECT * FROM PHENOMENA WHERE PHE_DATE = '$year-$month-$day_select'";
					$sql_info_phenomena = mysqli_query($conexao, $query_phenomena) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
					$phenomena = mysqli_fetch_assoc($sql_info_phenomena);

					$query_mission = "SELECT * FROM MISSIONS WHERE MIS_DATE = '$year-$month-$day_select'";
					$sql_info_mission = mysqli_query($conexao, $query_mission) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
					$missions = mysqli_fetch_assoc($sql_info_mission);

					$query_releases = "SELECT * FROM RELEASES WHERE REL_DATE = '$year-$month-$day_select'";
					$sql_info_releases = mysqli_query($conexao, $query_releases) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
					$releases = mysqli_fetch_assoc($sql_info_releases);

					// Aqui onde o dia é exibido
					echo "<a class='day-calendar' href = " . $_SERVER["PHP_SELF"] . "?dia=" . ($current_day + 1) . ">" . ++$current_day . "</a>";
					// if de verificação para cada cor do marcador do calendário
					if (!empty($phenomena)) {
						echo "<span class='event' style='background-color:#da5f5f;'></span>";
					}
					if (!empty($missions)) {
						echo "<span class='event' style='background-color:#5a9ab2;'></span>";
					}
					if (!empty($releases)) {
						echo "<span class='event' style='background-color:#91c33b;'></span></td>";
					}
				}
			} else {
				break;
			}
			// finalizado trecho do codigo referente a cada dia

			echo "</td>";
		}
		echo "</tr>";
	}

	echo "</table>";
	// fechamento da tabela acima
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CALENDÁRIO ASTRONÔMICO</title>

	<!-- Css -->
	<link rel="stylesheet" href="../src/project/css/styles.css">
	<link rel="stylesheet" href="../src/project/css/calendar.css">
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

	<!-- Onde é realizada a busca dos eventos que ocorrem na data selecionada -->
	<?php
	ini_set('default_charset', 'UTF-8');

	error_reporting(0);
	include_once("../config/conectar.php");

	$conexao = $conexao;

	$query_phenomena = "SELECT * FROM PHENOMENA WHERE PHE_DATE = '$year-$month-$day'";
	$sql_info_phenomena = mysqli_query($conexao, $query_phenomena) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

	$query_mission = "SELECT * FROM MISSIONS WHERE MIS_DATE = '$year-$month-$day'";
	$sql_info_mission = mysqli_query($conexao, $query_mission) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

	$query_releases = "SELECT * FROM RELEASES WHERE REL_DATE = '$year-$month-$day'";
	$sql_info_releases = mysqli_query($conexao, $query_releases) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
	?>

	<!-- Seçao de menu -->
	<section class="row top-menu">

		<!-- Divs menu e de recarga -->
		<div class="col-md-11 col-sm-11 title-menu">
			<a class="button-calendar" href="index.php" title="Recarregar" style="margin-left: 30px;"> <i class="fas fa-redo"></i> Recarregar</a>
			<h1>Calendário Astronômico</h1>
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
	<section class="row section-index">

		<!-- div contendo o calendário -->
		<div class="col-md-7 col-12 col-sm-12">
			<div class="form-index">
				<form action="index.php" method="POST">
					<input type="date" name="DATE" id="date" ?>
					<input class="button-calendar button-form" title="Selecionar Data" class="btn-form-index" type="submit" name="date" value="Buscar">
				</form>
			</div>

			<!-- chamada para o calendário com a data e o valor de conexão para não travar a função -->
			<?php
			MostreCalendario($day, $month, $year, $conexao);
			?>

			<!-- Informação referente as cores dos eventos -->
			<div class="div-info-calendar">
				<p>FENÔMENOS <span class='event' style='background-color:#da5f5f;'></span></p>
				<p>MISSÕES <span class='event' style='background-color:#5a9ab2;'></span></p>
				<p>LANÇAMENTOS <span class='event' style='background-color:#91c33b;'></span></p>
			</div>

		</div>

		<!-- Div onde são informados os eventos da data selecionada -->
		<div class="col-md-5 col-sm-12 col-12 info-div-date">
			<h2><?= "$day / $month / $year" ?></h2>
			<?php while ($phenomena = mysqli_fetch_assoc($sql_info_phenomena)) :  ?>
				<div class="itm-info"><i class="fas fa-sun"> </i>
					<p> <?php echo ($phenomena['PHE_NAME']) ?></p>
				</div>
			<?php endwhile; ?>
			<?php while ($missions = mysqli_fetch_assoc($sql_info_mission)) :  ?>
				<div class="itm-info"><i class="fab fa-galactic-republic"> </i>
					<p> <?php echo ($missions['MIS_NAME']) ?></p>
				</div>
			<?php endwhile; ?>
			<?php while ($releases = mysqli_fetch_assoc($sql_info_releases)) :  ?>
				<div class="itm-info"><i class="fas fa-rocket"></i>
					<p> <?php echo ($releases['REL_NAME']) ?></p>
				</div>
			<?php endwhile; ?>
		</div>
	</section>

</body>

<footer>
</footer>

</html>
