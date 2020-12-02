<?php
include_once("../config/conectar.php");

// Função Deletar
if (isset($_GET['tabela_sta']) && isset($_GET['nomepk_sta']) && isset($_GET['codigo_sta']) && isset($_GET['tabela_gen']) && isset($_GET['nomepk_gen']) && isset($_GET['codigo_gen']) && isset($_GET['origem'])) {
    $tabela_sta = $_GET['tabela_sta'];
    $nomepk_sta = $_GET['nomepk_sta'];
    $codigo_sta = $_GET['codigo_sta'];
    $tabela_gen = $_GET['tabela_gen'];
    $nomepk_gen = $_GET['nomepk_gen'];
    $codigo_gen = $_GET['codigo_gen'];
    $origem = $_GET['origem'];

    $query_sta = "DELETE FROM $tabela_sta WHERE $nomepk_sta = $codigo_sta";
    $sql_obj = mysqli_query($conexao, $query_sta) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_gen = "DELETE FROM $tabela_gen WHERE $nomepk_gen = $codigo_gen";
    $sql_gen = mysqli_query($conexao, $query_gen) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

?>
    <script>
        alert("Estrela APAGADA com Sucesso!");
        window.location = "../gerenciar/stars.php";
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
    $STA_CODE = $_POST['STA_CODE'];
    $STA_COLOR = $_POST['STA_COLOR'];
    if ($_POST['STA_SYS_CODE'] != 0) {
        $STA_SYS_CODE = $_POST['STA_SYS_CODE'];
    }

    $query1 = "UPDATE GENERIC SET GEN_NAME = '$GEN_NAME', GEN_DESCRIPTION = '$GEN_DESCRIPTION', GEN_DISTANCE = '$GEN_DISTANCE', GEN_MASS = '$GEN_MASS' WHERE GEN_CODE = '$GEN_CODE' ";
    mysqli_query($conexao, $query1) or die("Erro: não foi possível atualizar o registro no banco de dados!" . mysqli_error($conexao));

    if (!empty($STA_SYS_CODE)) {
        $query2 = "UPDATE STARS SET STA_COLOR = '$STA_COLOR', STA_SYS_CODE = '$STA_SYS_CODE' WHERE STA_CODE = '$STA_CODE' ";
        mysqli_query($conexao, $query2) or die("Erro: não foi possível atualizar o registro no banco de dados!" . mysqli_error($conexao));
    } else {
        $query2 = "UPDATE STARS SET STA_COLOR = '$STA_COLOR', STA_SYS_CODE = NULL WHERE STA_CODE = '$STA_CODE' ";
        mysqli_query($conexao, $query2) or die("Erro: não foi possível atualizar o registro no banco de dados!" . mysqli_error($conexao));
    }

    mysqli_close($conexao);
?>

    <script>
        alert("O Registro foi ATUALIZADO com Sucesso!");
        window.location = "../gerenciar/stars.php";
    </script>

<?php

    // Função Salvar
} else if (isset($_POST['enviar'])) {
    $GEN_NAME = $_POST['GEN_NAME'];
    $GEN_DESCRIPTION = $_POST['GEN_DESCRIPTION'];
    $GEN_DISTANCE = $_POST['GEN_DISTANCE'];
    $GEN_MASS = $_POST['GEN_MASS'];
    $GEN_CREATED = date('Y-m-d H:i:s');
    $STA_COLOR = $_POST['STA_COLOR'];
    if ($_POST['STA_SYS_CODE'] != 0) {
        $STA_SYS_CODE = $_POST['STA_SYS_CODE'];
    }

    $query1 = "INSERT INTO GENERIC (GEN_NAME, GEN_DESCRIPTION, GEN_DISTANCE, GEN_MASS, GEN_CREATED) 
            VALUES ('$GEN_NAME', '$GEN_DESCRIPTION', '$GEN_DISTANCE', '$GEN_MASS', '$GEN_CREATED');";

    mysqli_query($conexao, $query1) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));

    if (!empty($STA_SYS_CODE)) {
        $query2 = "INSERT INTO STARS (STA_COLOR, STA_SYS_CODE, STA_GEN_CODE) 
        VALUES ('$STA_COLOR', '$STA_SYS_CODE', (SELECT LAST_INSERT_ID()));";
    } else {
        $query2 = "INSERT INTO STARS (STA_COLOR, STA_SYS_CODE, STA_GEN_CODE) 
        VALUES ('$STA_COLOR', NULL, (SELECT LAST_INSERT_ID()));";
    }

    mysqli_query($conexao, $query2) or die("Erro: não foi possível registrar no banco de dados!" . $STA_SYS_CODE . mysqli_error($conexao));
    mysqli_close($conexao);
?>

    <script>
        alert("Estrela CADASTRADA com Sucesso!");
        window.location = "../gerenciar/stars.php";
    </script>

<?php
}
?>