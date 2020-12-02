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
        alert("Cometa APAGADO com Sucesso!");
        window.location = "../gerenciar/comets.php";
    </script>
<?php

    // função Editar
} else if (isset($_POST['edit'])) {

    ini_set('default_charset', 'UTF-8');
    error_reporting(0);

    $GEN_CODE = $_POST['GEN_CODE'];
    $GEN_NAME = $_POST['GEN_NAME'];
    $GEN_DESCRIPTION = $_POST['GEN_DESCRIPTION'];
    $GEN_DISTANCE = $_POST['GEN_DISTANCE'];
    $GEN_MASS = $_POST['GEN_MASS'];
    $COM_CODE = $_POST['COM_CODE'];
    $COM_DISCOVERY = $_POST['COM_DISCOVERY'];
    if ($_POST['COM_GAL_CODE'] != 0) {
        $COM_GAL_CODE = $_POST['COM_GAL_CODE'];
    }

    $query1 = "UPDATE GENERIC SET GEN_NAME = '$GEN_NAME', GEN_DESCRIPTION = '$GEN_DESCRIPTION', GEN_DISTANCE = '$GEN_DISTANCE', GEN_MASS = '$GEN_MASS' WHERE GEN_CODE = '$GEN_CODE' ";
    mysqli_query($conexao, $query1) or die("Erro: não foi possível atualizar o registro no banco de dados!" . mysqli_error($conexao));

    if (!empty($COM_GAL_CODE)) {
        $query2 = "UPDATE COMETS SET COM_DISCOVERY = '$COM_DISCOVERY', COM_GAL_CODE = '$COM_GAL_CODE' WHERE COM_CODE = '$COM_CODE' ";
        mysqli_query($conexao, $query2) or die("Erro: não foi possível atualizar o registro no banco de dados!" . mysqli_error($conexao));
    } else {
        $query2 = "UPDATE COMETS SET COM_DISCOVERY = '$COM_DISCOVERY', COM_GAL_CODE = NULL WHERE COM_CODE = '$COM_CODE' ";
        mysqli_query($conexao, $query2) or die("Erro: não foi possível atualizar o registro no banco de dados!" . mysqli_error($conexao));
    }

    mysqli_close($conexao);
?>

    <script>
        alert("O Registro foi ATUALIZADO com Sucesso!");
        window.location = "../gerenciar/comets.php";
    </script>

<?php

    // Função Salvar
} else if (isset($_POST['enviar'])) {
    $GEN_NAME = $_POST['GEN_NAME'];
    $GEN_DESCRIPTION = $_POST['GEN_DESCRIPTION'];
    $GEN_DISTANCE = $_POST['GEN_DISTANCE'];
    $GEN_MASS = $_POST['GEN_MASS'];
    $GEN_CREATED = date('Y-m-d H:i:s');
    $COM_DISCOVERY = $_POST['COM_DISCOVERY'];
    if ($_POST['COM_GAL_CODE'] != 0) {
        $COM_GAL_CODE = $_POST['COM_GAL_CODE'];
    }

    $query1 = "INSERT INTO GENERIC (GEN_NAME, GEN_DESCRIPTION, GEN_DISTANCE, GEN_MASS, GEN_CREATED) 
            VALUES ('$GEN_NAME', '$GEN_DESCRIPTION', '$GEN_DISTANCE', '$GEN_MASS', '$GEN_CREATED');";

    mysqli_query($conexao, $query1) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));

    if (!empty($COM_GAL_CODE)) {
        $query2 = "INSERT INTO COMETS (COM_DISCOVERY, COM_GAL_CODE, COM_GEN_CODE) 
        VALUES ('$COM_DISCOVERY', '$COM_GAL_CODE', (SELECT LAST_INSERT_ID()));";
    } else {
        $query2 = "INSERT INTO COMETS (COM_DISCOVERY, COM_GAL_CODE, COM_GEN_CODE) 
        VALUES ('$COM_DISCOVERY', NULL, (SELECT LAST_INSERT_ID()));";
    }


    mysqli_query($conexao, $query2) or die("Erro: não foi possível registrar no banco de dados!" . $COM_GAL_CODE . mysqli_error($conexao));
    mysqli_close($conexao);
?>

    <script>
        alert("Cometas CADASTRADO com Sucesso!");
        window.location = "../gerenciar/comets.php";
    </script>

<?php
}
?>