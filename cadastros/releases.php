<?php
include_once("../config/conectar.php");

// Função Deletar
if(isset($_GET['tabela_rel']) && isset($_GET['nomepk_rel']) && isset($_GET['codigo_rel']) && isset($_GET['origem'])){
    $tabela_rel = $_GET['tabela_rel'];
	$nomepk_rel = $_GET['nomepk_rel'];
    $codigo_rel = $_GET['codigo_rel'];
    $origem = $_GET['origem'];
    
    $query_missions = "DELETE FROM RELEASE_MISSION WHERE REM_REL_CODE = $codigo_rel";
    $sql_missions = mysqli_query($conexao, $query_missions) or die ('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_phenomena = "DELETE FROM RELEASE_PHENOMENA WHERE REP_REL_CODE = $codigo_rel";
    $sql_phenomena = mysqli_query($conexao, $query_phenomena) or die ('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
    
	$query_rel = "DELETE FROM $tabela_rel WHERE $nomepk_rel = $codigo_rel";
    $sql_rel = mysqli_query($conexao, $query_rel) or die ('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
        
    ?>
    <script>
        alert("Lançamento APAGADO com Sucesso!");
        window.location="../gerenciar/releases.php";
    </script>
    <?php

    // Função Editar
} else if(isset($_POST['edit'])){

    ini_set('default_charset','UTF-8');
    error_reporting(0);

    $REL_CODE = $_POST['REL_CODE'];
    $REL_NAME = $_POST['REL_NAME'];
    $REL_COMPANY = $_POST['REL_COMPANY'];
    $REL_LOCAL = $_POST['REL_LOCAL'];
    $REL_DESTINY = $_POST['REL_DESTINY'];
    $REL_DESCRIPTION = $_POST['REL_DESCRIPTION'];
    $REL_DATE = $_POST['REL_DATE'];
    if($_POST['REP_PHE_CODE'] != 0) {
        $REP_PHE_CODE = $_POST['REP_PHE_CODE'];
    }
    if($_POST['REM_MIS_CODE'] != 0) {
        $REM_MIS_CODE = $_POST['REM_MIS_CODE'];
    }

    // Deleta os associados
    $query_mission = "DELETE FROM RELEASE_MISSION WHERE REM_REL_CODE = $REL_CODE";
    $sql_mission = mysqli_query($conexao, $query_mission) or die ('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));    

    $query_phenomena = "DELETE FROM RELEASE_PHENOMENA WHERE REP_REL_CODE = $REL_CODE";
    $sql_phenomena = mysqli_query($conexao, $query_phenomena) or die ('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
  
    // Atualiza o cadastro da missão
    $query1 = "UPDATE RELEASES SET REL_NAME = '$REL_NAME', REL_COMPANY = '$REL_COMPANY', REL_LOCAL = '$REL_LOCAL', REL_DESTINY = '$REL_DESTINY', REL_DESCRIPTION = '$REL_DESCRIPTION', REL_DATE = '$REL_DATE' WHERE REL_CODE = '$REL_CODE' "; 
    mysqli_query($conexao, $query1) or die("Erro: não foi possível atualizar o registro no banco de dados!" . mysqli_error($conexao));

    // Adiciona os associados
    if(!empty($REM_MIS_CODE)) {
        $query_mission = "INSERT INTO RELEASE_MISSION (REM_REL_CODE, REM_MIS_CODE) 
        VALUES ('$REL_CODE', '$REM_MIS_CODE');";
        mysqli_query($conexao, $query_mission) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if(!empty($REP_PHE_CODE)) {
        $query_phenomena = "INSERT INTO RELEASE_PHENOMENA (REP_REL_CODE, REP_PHE_CODE) 
        VALUES ('$REL_CODE', '$REP_PHE_CODE');";
        mysqli_query($conexao, $query_phenomena) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }

    mysqli_close($conexao);
    ?>
  
    <script>
      alert("O Registro foi Atualizado com Sucesso!");
      window.location="../gerenciar/releases.php";
    </script>
  
    <?php

    // Função Salvar
} else if (isset($_POST['enviar'])){

    $REL_CODE = $_POST['REL_CODE'];
    $REL_NAME = $_POST['REL_NAME'];
    $REL_COMPANY = $_POST['REL_COMPANY'];
    $REL_LOCAL = $_POST['REL_LOCAL'];
    $REL_DESTINY = $_POST['REL_DESTINY'];
    $REL_DESCRIPTION = $_POST['REL_DESCRIPTION'];
    $REL_DATE = $_POST['REL_DATE'];
    $REL_CREATED = date('Y-m-d H:i:s');
    if($_POST['REP_PHE_CODE'] != 0) {
        $REP_PHE_CODE = $_POST['REP_PHE_CODE'];
    }
    if($_POST['REM_MIS_CODE'] != 0) {
        $REM_MIS_CODE = $_POST['REM_MIS_CODE'];
    }


    $query_releases = "INSERT INTO RELEASES (REL_NAME, REL_COMPANY, REL_LOCAL, REL_DESTINY, REL_DESCRIPTION, REL_DATE, REL_CREATED) 
            VALUES ('$REL_NAME', '$REL_COMPANY', '$REL_LOCAL', '$REL_DESTINY', '$REL_DESCRIPTION', '$REL_DATE', '$REL_CREATED');";
    mysqli_query($conexao, $query_releases) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));

    $LAST_ID = mysqli_query($conexao, '(SELECT LAST_INSERT_ID())') or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    $LAST_ID = mysqli_fetch_row($LAST_ID);
    $LAST_ID = $LAST_ID[0];
    // Adiciona os associados
    if(!empty($REP_PHE_CODE)) {
        $query_galaxys = "INSERT INTO RELEASE_PHENOMENA (REP_REL_CODE, REP_PHE_CODE) 
        VALUES ($LAST_ID, '$REP_PHE_CODE');";
        mysqli_query($conexao, $query_galaxys) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if(!empty($REM_MIS_CODE)) {
        $query_systems = "INSERT INTO RELEASE_MISSION (REM_REL_CODE, REM_MIS_CODE) 
        VALUES ($LAST_ID, '$REM_MIS_CODE');";
        mysqli_query($conexao, $query_systems) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }

    mysqli_close($conexao);
    ?>
  
    <script>
      alert("Lançamento CADASTRADO com Sucesso!");
      window.location="../gerenciar/releases.php";
    </script>
  
    <?php
}
?>