<?php
include_once("../config/conectar.php");

// Função Deletar
if (isset($_GET['tabela_obj']) && isset($_GET['nomepk_obj']) && isset($_GET['codigo_obj']) && isset($_GET['tabela_gen']) && isset($_GET['nomepk_gen']) && isset($_GET['codigo_gen']) && isset($_GET['origem'])) {
    $tabela_obj = $_GET['tabela_obj'];
    $nomepk_obj = $_GET['nomepk_obj'];
    $codigo_obj = $_GET['codigo_obj'];
    $tabela_gen = $_GET['tabela_gen'];
    $nomepk_gen = $_GET['nomepk_gen'];
    $codigo_gen = $_GET['codigo_gen'];
    $origem = $_GET['origem'];

    $query_sys = "DELETE FROM $tabela_obj WHERE $nomepk_obj = $codigo_obj";
    $sql_sys = mysqli_query($conexao, $query_sys) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_gen = "DELETE FROM $tabela_gen WHERE $nomepk_gen = $codigo_gen";
    $sql_gen = mysqli_query($conexao, $query_gen) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

?>
    <script>
        alert("Planeta APAGADO com Sucesso!");
        window.location = "../gerenciar/planets.php";
    </script>
<?php

    // Função Editar
} else if (isset($_POST['edit'])) {

    ini_set('default_charset', 'UTF-8');
    error_reporting(0);

    $GEN_CODE = $_POST['GEN_CODE'];
    $GEN_NAME = $_POST['GEN_NAME'];
    $GEN_DESCRIPTION = $_POST['GEN_DESCRIPTION'];
    $GEN_DISTANCE = $_POST['GEN_DISTANCE'];
    $GEN_MASS = $_POST['GEN_MASS'];
    $PLA_CODE = $_POST['PLA_CODE'];
    $PLA_HOURS_DAY = $_POST['PLA_HOURS_DAY'];
    if ($_POST['PLA_STA_CODE'] != 0) {
        $PLA_STA_CODE = $_POST['PLA_STA_CODE'];
    }

    $query1 = "UPDATE GENERIC SET GEN_NAME = '$GEN_NAME', GEN_DESCRIPTION = '$GEN_DESCRIPTION', GEN_DISTANCE = '$GEN_DISTANCE', GEN_MASS = '$GEN_MASS' WHERE GEN_CODE = '$GEN_CODE' ";
    mysqli_query($conexao, $query1) or die("Erro: não foi possível atualizar o registro no banco de dados!" . mysqli_error($conexao));

    if (!empty($PLA_STA_CODE)) {
        $query2 = "UPDATE PLANETS SET PLA_HOURS_DAY = '$PLA_HOURS_DAY', PLA_STA_CODE = '$PLA_STA_CODE' WHERE PLA_CODE = '$PLA_CODE' ";
        mysqli_query($conexao, $query2) or die("Erro: não foi possível atualizar o registro no banco de dados!" . mysqli_error($conexao));
    } else {
        $query2 = "UPDATE PLANETS SET PLA_HOURS_DAY = '$PLA_HOURS_DAY', PLA_STA_CODE = NULL WHERE PLA_CODE = '$PLA_CODE' ";
        mysqli_query($conexao, $query2) or die("Erro: não foi possível atualizar o registro no banco de dados!" . mysqli_error($conexao));
    }

    mysqli_close($conexao);
?>

    <script>
        alert("O Registro foi ATUALIZADO com Sucesso!");
        window.location = "../gerenciar/planets.php";
    </script>

<?php

    // Função Enviar
} else if (isset($_POST['enviar'])) {
    $GEN_NAME = $_POST['GEN_NAME'];
    $GEN_DESCRIPTION = $_POST['GEN_DESCRIPTION'];
    $GEN_DISTANCE = $_POST['GEN_DISTANCE'];
    $GEN_MASS = $_POST['GEN_MASS'];
    $GEN_CREATED = date('Y-m-d H:i:s');
    $PLA_HOURS_DAY = $_POST['PLA_HOURS_DAY'];
    if ($_POST['PLA_STA_CODE'] != 0) {
        $PLA_STA_CODE = $_POST['PLA_STA_CODE'];
    }

    $query1 = "INSERT INTO GENERIC (GEN_NAME, GEN_DESCRIPTION, GEN_DISTANCE, GEN_MASS, GEN_CREATED) 
            VALUES ('$GEN_NAME', '$GEN_DESCRIPTION', '$GEN_DISTANCE', '$GEN_MASS', '$GEN_CREATED');";

    mysqli_query($conexao, $query1) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));

    if (!empty($PLA_STA_CODE)) {
        $query2 = "INSERT INTO PLANETS (PLA_HOURS_DAY, PLA_STA_CODE, PLA_GEN_CODE) 
        VALUES ('$PLA_HOURS_DAY', '$PLA_STA_CODE', (SELECT LAST_INSERT_ID()));";
    } else {
        $query2 = "INSERT INTO PLANETS (PLA_HOURS_DAY, PLA_STA_CODE, PLA_GEN_CODE) 
        VALUES ('$PLA_HOURS_DAY', NULL, (SELECT LAST_INSERT_ID()));";
    }


    mysqli_query($conexao, $query2) or die("Erro: não foi possível registrar no banco de dados!" . $PLA_STA_CODE . mysqli_error($conexao));
    mysqli_close($conexao);
?>

    <script>
        alert("Planeta CADASTRADO com Sucesso!");
        window.location = "../gerenciar/planets.php";
    </script>

<?php
}
?>