<?php
include_once("../config/conectar.php");

if(isset($_GET['tabela_phe']) && isset($_GET['nomepk_phe']) && isset($_GET['codigo_phe']) && isset($_GET['origem'])){
    $tabela_phe = $_GET['tabela_phe'];
	$nomepk_phe = $_GET['nomepk_phe'];
    $codigo_phe = $_GET['codigo_phe'];
    $origem = $_GET['origem'];
    
    $query_galaxy = "DELETE FROM PHENOMENA_GALAXYS WHERE PHG_PHE_CODE = $codigo_phe";
    $sql_galaxy = mysqli_query($conexao, $query_galaxy) or die ('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_systems = "DELETE FROM PHENOMENA_SYSTEMS WHERE PHS_PHE_CODE = $codigo_phe";
    $sql_systems = mysqli_query($conexao, $query_systems) or die ('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
    
    $query_stars = "DELETE FROM PHENOMENA_STARS WHERE PST_PHE_CODE = $codigo_phe";
    $sql_stars = mysqli_query($conexao, $query_stars) or die ('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_planets = "DELETE FROM PHENOMENA_PLANETS WHERE PHP_PHE_CODE = $codigo_phe";
    $sql_planets = mysqli_query($conexao, $query_planets) or die ('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_satellites = "DELETE FROM PHENOMENA_SATELLITES WHERE PSA_PHE_CODE = $codigo_phe";
    $sql_satellites = mysqli_query($conexao, $query_satellites) or die ('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_comets = "DELETE FROM PHENOMENA_COMETS WHERE PHC_PHE_CODE = $codigo_phe";
    $sql_comets = mysqli_query($conexao, $query_comets) or die ('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

	$query_phe = "DELETE FROM $tabela_phe WHERE $nomepk_phe = $codigo_phe";
    $sql_phe = mysqli_query($conexao, $query_phe) or die ('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
        
    ?>
    <script>
        alert("Fenômeno APAGADO com Sucesso!");
        window.location="../gerenciar/phenomena.php";
    </script>
    <?php
} else if(isset($_POST['edit'])){

    ini_set('default_charset','UTF-8');
    error_reporting(0);

    $PHE_CODE = $_POST['PHE_CODE'];
    $PHE_NAME = $_POST['PHE_NAME'];
    $PHE_DESCRIPTION = $_POST['PHE_DESCRIPTION'];
    $PHE_DATE = $_POST['PHE_DATE'];
    if($_POST['PHG_GAL_CODE'] != 0) {
        $PHG_GAL_CODE = $_POST['PHG_GAL_CODE'];
    }
    if($_POST['PHS_SYS_CODE'] != 0) {
        $PHS_SYS_CODE = $_POST['PHS_SYS_CODE'];
    }
    if($_POST['PST_STA_CODE'] != 0) {
        $PST_STA_CODE = $_POST['PST_STA_CODE'];
    }
    if($_POST['PHP_PLA_CODE'] != 0) {
        $PHP_PLA_CODE = $_POST['PHP_PLA_CODE'];
    }
    if($_POST['PSA_SAT_CODE'] != 0) {
        $PSA_SAT_CODE = $_POST['PSA_SAT_CODE'];
    }
    if($_POST['PHC_COM_CODE'] != 0) {
        $PHC_COM_CODE = $_POST['PHC_COM_CODE'];
    }

    // Deleta os associados
    $query_galaxy = "DELETE FROM PHENOMENA_GALAXYS WHERE PHG_PHE_CODE = $PHE_CODE";
    $sql_galaxy = mysqli_query($conexao, $query_galaxy) or die ('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));    

    $query_systems = "DELETE FROM PHENOMENA_SYSTEMS WHERE PHS_PHE_CODE = $PHE_CODE";
    $sql_systems = mysqli_query($conexao, $query_systems) or die ('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_stars = "DELETE FROM PHENOMENA_STARS WHERE PST_PHE_CODE = $PHE_CODE";
    $sql_stars = mysqli_query($conexao, $query_stars) or die ('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_planets = "DELETE FROM PHENOMENA_PLANETS WHERE PHP_PHE_CODE = $PHE_CODE";
    $sql_planets = mysqli_query($conexao, $query_planets) or die ('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_satellites = "DELETE FROM PHENOMENA_SATELLITES WHERE PSA_PHE_CODE = $PHE_CODE";
    $sql_satellites = mysqli_query($conexao, $query_satellites) or die ('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_comets = "DELETE FROM PHENOMENA_COMETS WHERE PHC_PHE_CODE = $PHE_CODE";
    $sql_comets = mysqli_query($conexao, $query_comets) or die ('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

  
    // Atualiza o cadastro do Fenômeno
    $query1 = "UPDATE PHENOMENA SET PHE_NAME = '$PHE_NAME', PHE_DESCRIPTION = '$PHE_DESCRIPTION', PHE_DATE = '$PHE_DATE' WHERE PHE_CODE = '$PHE_CODE' "; 
    mysqli_query($conexao, $query1) or die("Erro: não foi possível atualizar o registro no banco de dados!" . mysqli_error($conexao));

    // Adiciona os associados
    if(!empty($PHG_GAL_CODE)) {
        $query_galaxys = "INSERT INTO PHENOMENA_GALAXYS (PHG_PHE_CODE, PHG_GAL_CODE) 
        VALUES ('$PHE_CODE', '$PHG_GAL_CODE');";
        mysqli_query($conexao, $query_galaxys) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if(!empty($PHS_SYS_CODE)) {
        $query_systems = "INSERT INTO PHENOMENA_SYSTEMS (PHS_PHE_CODE, PHS_SYS_CODE) 
        VALUES ('$PHE_CODE', '$PHS_SYS_CODE');";
        mysqli_query($conexao, $query_systems) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if(!empty($PST_STA_CODE)) {
        $query_stars = "INSERT INTO PHENOMENA_STARS (PST_PHE_CODE, PST_STA_CODE) 
        VALUES ('$PHE_CODE', '$PST_STA_CODE');";
        mysqli_query($conexao, $query_stars) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if(!empty($PHP_PLA_CODE)) {
        $query_planets = "INSERT INTO PHENOMENA_PLANETS (PHP_PHE_CODE, PHP_PLA_CODE) 
        VALUES ('$PHE_CODE', '$PHP_PLA_CODE');";
        mysqli_query($conexao, $query_planets) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if(!empty($PSA_SAT_CODE)) {
        $query_satellites = "INSERT INTO PHENOMENA_SATELLITES (PSA_PHE_CODE, PSA_SAT_CODE) 
        VALUES ('$PHE_CODE', '$PSA_SAT_CODE');";
        mysqli_query($conexao, $query_satellites) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if(!empty($PHC_COM_CODE)) {
        $query_comets = "INSERT INTO PHENOMENA_COMETS (PHC_PHE_CODE, PHC_COM_CODE) 
        VALUES ('$PHE_CODE', '$PHC_COM_CODE');";
        mysqli_query($conexao, $query_comets) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }

    mysqli_close($conexao);
    ?>
  
    <script>
      alert("O Registro foi Atualizado com Sucesso!");
      window.location="../gerenciar/phenomena.php";
    </script>
  
    <?php
} else if (isset($_POST['enviar'])){

    $PHE_NAME = $_POST['PHE_NAME'];
    $PHE_DESCRIPTION = $_POST['PHE_DESCRIPTION'];
    $PHE_DATE = $_POST['PHE_DATE'];
    $PHE_CREATED = date('Y-m-d H:i:s');
    if($_POST['PHG_GAL_CODE'] != 0) {
        $PHG_GAL_CODE = $_POST['PHG_GAL_CODE'];
    }
    if($_POST['PHS_SYS_CODE'] != 0) {
        $PHS_SYS_CODE = $_POST['PHS_SYS_CODE'];
    }
    if($_POST['PST_STA_CODE'] != 0) {
        $PST_STA_CODE = $_POST['PST_STA_CODE'];
    }
    if($_POST['PHP_PLA_CODE'] != 0) {
        $PHP_PLA_CODE = $_POST['PHP_PLA_CODE'];
    }
    if($_POST['PSA_SAT_CODE'] != 0) {
        $PSA_SAT_CODE = $_POST['PSA_SAT_CODE'];
    }
    if($_POST['PHC_COM_CODE'] != 0) {
        $PHC_COM_CODE = $_POST['PHC_COM_CODE'];
    }


    $query_phenomena = "INSERT INTO PHENOMENA (PHE_NAME, PHE_DESCRIPTION, PHE_DATE, PHE_CREATED) 
            VALUES ('$PHE_NAME', '$PHE_DESCRIPTION', '$PHE_DATE', '$PHE_CREATED');";
    mysqli_query($conexao, $query_phenomena) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));

    $LAST_ID = mysqli_query($conexao, '(SELECT LAST_INSERT_ID())') or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    $LAST_ID = mysqli_fetch_row($LAST_ID);
    $LAST_ID = $LAST_ID[0];
    // Adiciona os associados
    if(!empty($PHG_GAL_CODE)) {
        $query_galaxys = "INSERT INTO PHENOMENA_GALAXYS (PHG_PHE_CODE, PHG_GAL_CODE) 
        VALUES ($LAST_ID, '$PHG_GAL_CODE');";
        mysqli_query($conexao, $query_galaxys) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if(!empty($PHS_SYS_CODE)) {
        $query_systems = "INSERT INTO PHENOMENA_SYSTEMS (PHS_PHE_CODE, PHS_SYS_CODE) 
        VALUES ($LAST_ID, '$PHS_SYS_CODE');";
        mysqli_query($conexao, $query_systems) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if(!empty($PST_STA_CODE)) {
        $query_stars = "INSERT INTO PHENOMENA_STARS (PST_PHE_CODE, PST_STA_CODE) 
        VALUES ($LAST_ID, '$PST_STA_CODE');";
        mysqli_query($conexao, $query_stars) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if(!empty($PHP_PLA_CODE)) {
        $query_planets = "INSERT INTO PHENOMENA_PLANETS (PHP_PHE_CODE, PHP_PLA_CODE) 
        VALUES ($LAST_ID, '$PHP_PLA_CODE');";
        mysqli_query($conexao, $query_planets) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if(!empty($PSA_SAT_CODE)) {
        $query_satellites = "INSERT INTO PHENOMENA_SATELLITES (PSA_PHE_CODE, PSA_SAT_CODE) 
        VALUES ($LAST_ID, '$PSA_SAT_CODE');";
        mysqli_query($conexao, $query_satellites) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }
    if(!empty($PHC_COM_CODE)) {
        $query_comets = "INSERT INTO PHENOMENA_COMETS (PHC_PHE_CODE, PHC_COM_CODE) 
        VALUES ($LAST_ID, '$PHC_COM_CODE');";
        mysqli_query($conexao, $query_comets) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    }

    mysqli_close($conexao);
    ?>
  
    <script>
      alert("Fenômenos CADASTRADO com Sucesso!");
      window.location="../gerenciar/phenomena.php";
    </script>
  
    <?php
}
?>