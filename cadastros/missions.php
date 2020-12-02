<?php
include_once("../config/conectar.php");

// Função Deletar
if (isset($_GET['tabela_mis']) && isset($_GET['nomepk_mis']) && isset($_GET['codigo_mis']) && isset($_GET['origem'])) {
    $tabela_mis = $_GET['tabela_mis'];
    $nomepk_mis = $_GET['nomepk_mis'];
    $codigo_mis = $_GET['codigo_mis'];
    $origem = $_GET['origem'];

    $query_galaxy = "DELETE FROM MISSIONS_GALAXYS WHERE MIG_MIS_CODE = $codigo_mis";
    $sql_galaxy = mysqli_query($conexao, $query_galaxy) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_systems = "DELETE FROM MISSIONS_SYSTEMS WHERE MSY_MIS_CODE = $codigo_mis";
    $sql_systems = mysqli_query($conexao, $query_systems) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_stars = "DELETE FROM MISSIONS_STARS WHERE MST_MIS_CODE = $codigo_mis";
    $sql_stars = mysqli_query($conexao, $query_stars) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_planets = "DELETE FROM MISSIONS_PLANETS WHERE MIP_MIS_CODE = $codigo_mis";
    $sql_planets = mysqli_query($conexao, $query_planets) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_satellites = "DELETE FROM MISSIONS_SATELLITES WHERE MSA_MIS_CODE = $codigo_mis";
    $sql_satellites = mysqli_query($conexao, $query_satellites) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_comets = "DELETE FROM MISSIONS_COMETS WHERE MIC_MIS_CODE = $codigo_mis";
    $sql_comets = mysqli_query($conexao, $query_comets) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_mis = "DELETE FROM $tabela_mis WHERE $nomepk_mis = $codigo_mis";
    $sql_mis = mysqli_query($conexao, $query_mis) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

?>
    <script>
        alert("Missão APAGADA com Sucesso!");
        window.location = "../gerenciar/missions.php";
    </script>
<?php

    // Função Editar
} else if (isset($_POST['edit'])) {

    ini_set('default_charset', 'UTF-8');
    error_reporting(0);

    $MIS_CODE = $_POST['MIS_CODE'];
    $MIS_NAME = $_POST['MIS_NAME'];
    $MIS_COMPANY = $_POST['MIS_COMPANY'];
    $MIS_LOCAL = $_POST['MIS_LOCAL'];
    $MIS_DESTINY = $_POST['MIS_DESTINY'];
    $MIS_OBJECTIVE = $_POST['MIS_OBJECTIVE'];
    $MIS_DESCRIPTION = $_POST['MIS_DESCRIPTION'];
    $MIS_DATE = $_POST['MIS_DATE'];
    if ($_POST['MIG_GAL_CODE'] != 0) {
        $MIG_GAL_CODE = $_POST['MIG_GAL_CODE'];
    }
    if ($_POST['MSY_SYS_CODE'] != 0) {
        $MSY_SYS_CODE = $_POST['MSY_SYS_CODE'];
    }
    if ($_POST['MST_STA_CODE'] != 0) {
        $MST_STA_CODE = $_POST['MST_STA_CODE'];
    }
    if ($_POST['MIP_PLA_CODE'] != 0) {
        $MIP_PLA_CODE = $_POST['MIP_PLA_CODE'];
    }
    if ($_POST['MSA_SAT_CODE'] != 0) {
        $MSA_SAT_CODE = $_POST['MSA_SAT_CODE'];
    }
    if ($_POST['MIC_COM_CODE'] != 0) {
        $MIC_COM_CODE = $_POST['MIC_COM_CODE'];
    }

    // Deleta os associados
    $query_galaxy = "DELETE FROM MISSIONS_GALAXYS WHERE MIG_MIS_CODE = $MIS_CODE";
    $sql_galaxy = mysqli_query($conexao, $query_galaxy) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_systems = "DELETE FROM MISSIONS_SYSTEMS WHERE MSY_MIS_CODE = $MIS_CODE";
    $sql_systems = mysqli_query($conexao, $query_systems) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_stars = "DELETE FROM MISSIONS_STARS WHERE MST_MIS_CODE = $MIS_CODE";
    $sql_stars = mysqli_query($conexao, $query_stars) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_planets = "DELETE FROM MISSIONS_PLANETS WHERE MIP_MIS_CODE = $MIS_CODE";
    $sql_planets = mysqli_query($conexao, $query_planets) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_satellites = "DELETE FROM MISSIONS_SATELLITES WHERE MSA_MIS_CODE = $MIS_CODE";
    $sql_satellites = mysqli_query($conexao, $query_satellites) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_comets = "DELETE FROM MISSIONS_COMETS WHERE MIC_MIS_CODE = $MIS_CODE";
    $sql_comets = mysqli_query($conexao, $query_comets) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));


    // Atualiza o cadastro da missão
    $query1 = "UPDATE MISSIONS SET MIS_NAME = '$MIS_NAME', MIS_COMPANY = '$MIS_COMPANY', MIS_LOCAL = '$MIS_LOCAL', MIS_DESTINY = '$MIS_DESTINY', MIS_OBJECTIVE = '$MIS_OBJECTIVE', MIS_DESCRIPTION = '$MIS_DESCRIPTION', MIS_DATE = '$MIS_DATE' WHERE MIS_CODE = '$MIS_CODE' ";
    mysqli_query($conexao, $query1) or die("Erro: não foi possível atualizar o registro no banco de dados!" . mysqli_error($conexao));

    // Adiciona os associados
    if (!empty($MIG_GAL_CODE)) {
        $query_galaxys = "INSERT INTO MISSIONS_GALAXYS (MIG_MIS_CODE, MIG_GAL_CODE) 
        VALUES ('$MIS_CODE', '$MIG_GAL_CODE');";
        mysqli_query($conexao, $query_galaxys) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if (!empty($MSY_SYS_CODE)) {
        $query_systems = "INSERT INTO MISSIONS_SYSTEMS (MSY_MIS_CODE, MSY_SYS_CODE) 
        VALUES ('$MIS_CODE', '$MSY_SYS_CODE');";
        mysqli_query($conexao, $query_systems) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if (!empty($MST_STA_CODE)) {
        $query_stars = "INSERT INTO MISSIONS_STARS (MST_MIS_CODE, MST_STA_CODE) 
        VALUES ('$MIS_CODE', '$MST_STA_CODE');";
        mysqli_query($conexao, $query_stars) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if (!empty($MIP_PLA_CODE)) {
        $query_planets = "INSERT INTO MISSIONS_PLANETS (MIP_MIS_CODE, MIP_PLA_CODE) 
        VALUES ('$MIS_CODE', '$MIP_PLA_CODE');";
        mysqli_query($conexao, $query_planets) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if (!empty($MSA_SAT_CODE)) {
        $query_satellites = "INSERT INTO MISSIONS_SATELLITES (MSA_MIS_CODE, MSA_SAT_CODE) 
        VALUES ('$MIS_CODE', '$MSA_SAT_CODE');";
        mysqli_query($conexao, $query_satellites) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if (!empty($MIC_COM_CODE)) {
        $query_comets = "INSERT INTO MISSIONS_COMETS (MIC_MIS_CODE, MIC_COM_CODE) 
        VALUES ('$MIS_CODE', '$MIC_COM_CODE');";
        mysqli_query($conexao, $query_comets) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }

    mysqli_close($conexao);
?>

    <script>
        alert("O Registro foi Atualizado com Sucesso!");
        window.location = "../gerenciar/missions.php";
    </script>

<?php

    // Função Salvar
} else if (isset($_POST['enviar'])) {

    $MIS_NAME = $_POST['MIS_NAME'];
    $MIS_NAME = $_POST['MIS_NAME'];
    $MIS_COMPANY = $_POST['MIS_COMPANY'];
    $MIS_LOCAL = $_POST['MIS_LOCAL'];
    $MIS_DESTINY = $_POST['MIS_DESTINY'];
    $MIS_OBJECTIVE = $_POST['MIS_OBJECTIVE'];
    $MIS_DESCRIPTION = $_POST['MIS_DESCRIPTION'];
    $MIS_DATE = $_POST['MIS_DATE'];
    $MIS_CREATED = date('Y-m-d H:i:s');
    if ($_POST['MIG_GAL_CODE'] != 0) {
        $MIG_GAL_CODE = $_POST['MIG_GAL_CODE'];
    }
    if ($_POST['MSY_SYS_CODE'] != 0) {
        $MSY_SYS_CODE = $_POST['MSY_SYS_CODE'];
    }
    if ($_POST['MST_STA_CODE'] != 0) {
        $MST_STA_CODE = $_POST['MST_STA_CODE'];
    }
    if ($_POST['MIP_PLA_CODE'] != 0) {
        $MIP_PLA_CODE = $_POST['MIP_PLA_CODE'];
    }
    if ($_POST['MSA_SAT_CODE'] != 0) {
        $MSA_SAT_CODE = $_POST['MSA_SAT_CODE'];
    }
    if ($_POST['MIC_COM_CODE'] != 0) {
        $MIC_COM_CODE = $_POST['MIC_COM_CODE'];
    }


    $query_missions = "INSERT INTO MISSIONS (MIS_NAME, MIS_COMPANY, MIS_LOCAL, MIS_DESTINY, MIS_OBJECTIVE, MIS_DESCRIPTION, MIS_DATE, MIS_CREATED) 
            VALUES ('$MIS_NAME', '$MIS_COMPANY', '$MIS_LOCAL', '$MIS_DESTINY', '$MIS_OBJECTIVE', '$MIS_DESCRIPTION', '$MIS_DATE', '$MIS_CREATED');";
    mysqli_query($conexao, $query_missions) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));

    $LAST_ID = mysqli_query($conexao, '(SELECT LAST_INSERT_ID())') or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    $LAST_ID = mysqli_fetch_row($LAST_ID);
    $LAST_ID = $LAST_ID[0];
    // Adiciona os associados
    if (!empty($MIG_GAL_CODE)) {
        $query_galaxys = "INSERT INTO MISSIONS_GALAXYS (MIG_MIS_CODE, MIG_GAL_CODE) 
        VALUES ($LAST_ID, '$MIG_GAL_CODE');";
        mysqli_query($conexao, $query_galaxys) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if (!empty($MSY_SYS_CODE)) {
        $query_systems = "INSERT INTO MISSIONS_SYSTEMS (MSY_MIS_CODE, MSY_SYS_CODE) 
        VALUES ($LAST_ID, '$MSY_SYS_CODE');";
        mysqli_query($conexao, $query_systems) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if (!empty($MST_STA_CODE)) {
        $query_stars = "INSERT INTO MISSIONS_STARS (MST_MIS_CODE, MST_STA_CODE) 
        VALUES ($LAST_ID, '$MST_STA_CODE');";
        mysqli_query($conexao, $query_stars) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if (!empty($MIP_PLA_CODE)) {
        $query_planets = "INSERT INTO MISSIONS_PLANETS (MIP_MIS_CODE, MIP_PLA_CODE) 
        VALUES ($LAST_ID, '$MIP_PLA_CODE');";
        mysqli_query($conexao, $query_planets) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if (!empty($MSA_SAT_CODE)) {
        $query_satellites = "INSERT INTO MISSIONS_SATELLITES (MSA_MIS_CODE, MSA_SAT_CODE) 
        VALUES ($LAST_ID, '$MSA_SAT_CODE');";
        mysqli_query($conexao, $query_satellites) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if (!empty($MIC_COM_CODE)) {
        $query_comets = "INSERT INTO MISSIONS_COMETS (MIC_MIS_CODE, MIC_COM_CODE) 
        VALUES ($LAST_ID, '$MIC_COM_CODE');";
        mysqli_query($conexao, $query_comets) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }

    mysqli_close($conexao);
?>

    <script>
        alert("Missão CADASTRADA com Sucesso!");
        window.location = "../gerenciar/missions.php";
    </script>

<?php
}
?>