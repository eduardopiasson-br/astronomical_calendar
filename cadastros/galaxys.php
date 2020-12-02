<?php
include_once("../config/conectar.php");

    // Função Deletar
if (isset($_GET['tabela_gal']) && isset($_GET['nomepk_gal']) && isset($_GET['codigo_gal']) && isset($_GET['tabela_gen']) && isset($_GET['nomepk_gen']) && isset($_GET['codigo_gen']) && isset($_GET['origem'])) {
    $tabela_gal = $_GET['tabela_gal'];
    $nomepk_gal = $_GET['nomepk_gal'];
    $codigo_gal = $_GET['codigo_gal'];
    $tabela_gen = $_GET['tabela_gen'];
    $nomepk_gen = $_GET['nomepk_gen'];
    $codigo_gen = $_GET['codigo_gen'];
    $origem = $_GET['origem'];

    $query_gal = "DELETE FROM $tabela_gal WHERE $nomepk_gal = $codigo_gal";
    $sql_gal = mysqli_query($conexao, $query_gal) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query_gen = "DELETE FROM $tabela_gen WHERE $nomepk_gen = $codigo_gen";
    $sql_gen = mysqli_query($conexao, $query_gen) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    mysqli_close($conexao);

?>
    <script>
        alert("Galaxia apagada com Sucesso!");
        window.location = "../gerenciar/galaxys.php";
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
    $GAL_CODE = $_POST['GAL_CODE'];
    $GAL_STARS = $_POST['GAL_STARS'];
    $GAL_DIAMETER = $_POST['GAL_DIAMETER'];
    $GAL_THICKNESS = $_POST['GAL_THICKNESS'];

    $query1 = "UPDATE GENERIC SET GEN_NAME = '$GEN_NAME', GEN_DESCRIPTION = '$GEN_DESCRIPTION', GEN_DISTANCE = '$GEN_DISTANCE', GEN_MASS = '$GEN_MASS' WHERE GEN_CODE = '$GEN_CODE' ";
    mysqli_query($conexao, $query1) or die("Erro: não foi possível atualizar o registro no banco de dados!" . mysqli_error($conexao));

    $query2 = "UPDATE GALAXYS SET GAL_STARS = '$GAL_STARS', GAL_DIAMETER = '$GAL_DIAMETER', GAL_THICKNESS = '$GAL_THICKNESS' WHERE GAL_CODE = '$GAL_CODE' ";
    mysqli_query($conexao, $query2) or die("Erro: não foi possível atualizar o registro no banco de dados!" . mysqli_error($conexao));

    mysqli_close($conexao);
?>

    <script>
        alert("O Registro foi Atualizado com Sucesso!");
        window.location = "../gerenciar/galaxys.php";
    </script>

<?php

    // Função Salvar
} else if (isset($_POST['enviar'])) {
    $GEN_NAME = $_POST['GEN_NAME'];
    $GEN_DESCRIPTION = $_POST['GEN_DESCRIPTION'];
    $GEN_DISTANCE = $_POST['GEN_DISTANCE'];
    $GEN_MASS = $_POST['GEN_MASS'];
    $GEN_CREATED = date('Y-m-d H:i:s');
    $GAL_STARS = $_POST['GAL_STARS'];
    $GAL_DIAMETER = $_POST['GAL_DIAMETER'];
    $GAL_THICKNESS = $_POST['GAL_THICKNESS'];

    $query1 = "INSERT INTO GENERIC (GEN_NAME, GEN_DESCRIPTION, GEN_DISTANCE, GEN_MASS, GEN_CREATED) 
            VALUES ('$GEN_NAME', '$GEN_DESCRIPTION', '$GEN_DISTANCE', '$GEN_MASS', '$GEN_CREATED');";

    mysqli_query($conexao, $query1) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));

    $query2 = "INSERT INTO GALAXYS (GAL_STARS, GAL_DIAMETER, GAL_THICKNESS, GAL_GEN_CODE) 
            VALUES ('$GAL_STARS', '$GAL_DIAMETER', '$GAL_THICKNESS', (SELECT LAST_INSERT_ID()));";

    mysqli_query($conexao, $query2) or die("Erro: não foi possível registrar no banco de dados!" . mysqli_error($conexao));
    mysqli_close($conexao);
?>

    <script>
        alert("Galaxia CADASTRADA com Sucesso!");
        window.location = "../gerenciar/galaxys.php";
    </script>

<?php
}
?>