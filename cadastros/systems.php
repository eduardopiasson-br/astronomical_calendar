<?php
include_once("../config/conectar.php");

if(isset($_GET['tabela_sys']) && isset($_GET['nomepk_sys']) && isset($_GET['codigo_sys']) && isset($_GET['tabela_gen']) && isset($_GET['nomepk_gen']) && isset($_GET['codigo_gen']) && isset($_GET['origem'])){
	$tabela_sys = $_GET['tabela_sys'];
	$nomepk_sys = $_GET['nomepk_sys'];
    $codigo_sys = $_GET['codigo_sys'];
    $tabela_gen = $_GET['tabela_gen'];
	$nomepk_gen = $_GET['nomepk_gen'];
	$codigo_gen = $_GET['codigo_gen'];
	$origem = $_GET['origem'];

	$query_sys = "DELETE FROM $tabela_sys WHERE $nomepk_sys = $codigo_sys";
    $sql_sys = mysqli_query($conexao, $query_sys) or die ('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
    
    $query_gen = "DELETE FROM $tabela_gen WHERE $nomepk_gen = $codigo_gen";
	$sql_gen = mysqli_query($conexao, $query_gen) or die ('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
    
    ?>
    <script>
        alert("Sistema Planetário apagado com Sucesso!");
        window.location="../gerenciar/systems.php";
    </script>
    <?php
} else if(isset($_POST['edit'])){

    ini_set('default_charset','UTF-8');
    error_reporting(0);

    $GEN_CODE = $_POST['GEN_CODE'];
    $GEN_NAME = $_POST['GEN_NAME'];
    $GEN_DESCRIPTION = $_POST['GEN_DESCRIPTION'];
    $GEN_DISTANCE = $_POST['GEN_DISTANCE'];
    $GEN_MASS = $_POST['GEN_MASS'];
    $SYS_CODE = $_POST['SYS_CODE'];
    $SYS_PLANETS = $_POST['SYS_PLANETS'];
    $SYS_DIAMETER = $_POST['SYS_DIAMETER'];
    $SYS_THICKNESS = $_POST['SYS_THICKNESS'];
    if($_POST['SYS_GAL_CODE'] != 0) {
        $SYS_GAL_CODE = $_POST['SYS_GAL_CODE'];
    } 
  
    $query1 = "UPDATE GENERIC SET GEN_NAME = '$GEN_NAME', GEN_DESCRIPTION = '$GEN_DESCRIPTION', GEN_DISTANCE = '$GEN_DISTANCE', GEN_MASS = '$GEN_MASS' WHERE GEN_CODE = '$GEN_CODE' "; 
    mysqli_query($conexao, $query1) or die("Erro: não foi possível atualizar o registro no banco de dados!" . mysqli_error($conexao));

    if(!empty($SYS_GAL_CODE)) {
        $query2 = "UPDATE SYSTEMS SET SYS_PLANETS = '$SYS_PLANETS', SYS_DIAMETER = '$SYS_DIAMETER', SYS_THICKNESS = '$SYS_THICKNESS', SYS_GAL_CODE = '$SYS_GAL_CODE' WHERE SYS_CODE = '$SYS_CODE' "; 
        mysqli_query($conexao, $query2) or die("Erro: não foi possível atualizar o registro no banco de dados!" . mysqli_error($conexao));
    } else {
        $query2 = "UPDATE SYSTEMS SET SYS_PLANETS = '$SYS_PLANETS', SYS_DIAMETER = '$SYS_DIAMETER', SYS_THICKNESS = '$SYS_THICKNESS', SYS_GAL_CODE = NULL WHERE SYS_CODE = '$SYS_CODE' "; 
        mysqli_query($conexao, $query2) or die("Erro: não foi possível atualizar o registro no banco de dados!" . mysqli_error($conexao));
    }

    mysqli_close($conexao);
    ?>
  
    <script>
      alert("O Registro foi Atualizado com Sucesso!");
      window.location="../gerenciar/systems.php";
    </script>
  
    <?php
} else if (isset($_POST['enviar'])){
    $GEN_NAME = $_POST['GEN_NAME'];
    $GEN_DESCRIPTION = $_POST['GEN_DESCRIPTION'];
    $GEN_DISTANCE = $_POST['GEN_DISTANCE'];
    $GEN_MASS = $_POST['GEN_MASS'];
    $GEN_CREATED = date('Y-m-d H:i:s');
    $SYS_PLANETS = $_POST['SYS_PLANETS'];
    $SYS_DIAMETER = $_POST['SYS_DIAMETER'];
    $SYS_THICKNESS = $_POST['SYS_THICKNESS'];
    if($_POST['SYS_GAL_CODE'] != 0) {
        $SYS_GAL_CODE = $_POST['SYS_GAL_CODE'];
    } 

    $query1 = "INSERT INTO GENERIC (GEN_NAME, GEN_DESCRIPTION, GEN_DISTANCE, GEN_MASS, GEN_CREATED) 
            VALUES ('$GEN_NAME', '$GEN_DESCRIPTION', '$GEN_DISTANCE', '$GEN_MASS', '$GEN_CREATED');";

    mysqli_query($conexao, $query1) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));

    if(!empty($SYS_GAL_CODE)) {
        $query2 = "INSERT INTO SYSTEMS (SYS_PLANETS, SYS_DIAMETER, SYS_THICKNESS, SYS_GAL_CODE, SYS_GEN_CODE) 
        VALUES ('$SYS_PLANETS', '$SYS_DIAMETER', '$SYS_THICKNESS', '$SYS_GAL_CODE', (SELECT LAST_INSERT_ID()));";
    } else {
        $query2 = "INSERT INTO SYSTEMS (SYS_PLANETS, SYS_DIAMETER, SYS_THICKNESS, SYS_GAL_CODE, SYS_GEN_CODE) 
        VALUES ('$SYS_PLANETS', '$SYS_DIAMETER', '$SYS_THICKNESS', NULL, (SELECT LAST_INSERT_ID()));";
    }


    mysqli_query($conexao, $query2) or die("Erro: não foi possível registrar no banco de dados!" . $SYS_GAL_CODE . mysqli_error($conexao));
    mysqli_close($conexao);
    ?>
  
    <script>
      alert("Sistema Planetário CADASTRADO com Sucesso!");
      window.location="../gerenciar/systems.php";
    </script>
  
    <?php
}
?>