<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Gerenciar Galáxias</title>

    <!-- Css -->
    <link rel="stylesheet" href="../src/admin/css/styles.css">
    <link rel="stylesheet" href="../src/admin/css/responsive.css">
    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Flaticon -->
    <link rel="shortcut icon" href="../src/admin/images/icon.png" />
    <!-- Js -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Bootstrap Js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Fontawesome icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Font-Family -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">

</head>

<body>
    <!-- Conexão com banco para trazer as informações já cadastradas -->
    <?php
    ini_set('default_charset', 'UTF-8');

    error_reporting(0);
    include_once("../config/conectar.php");

    $query = 'SELECT GEN_NAME, GEN_CODE FROM GENERIC INNER JOIN GALAXYS ON GENERIC.GEN_CODE = GALAXYS.GAL_GEN_CODE;';
    $sql_info_gal = mysqli_query($conexao, $query) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    include_once 'login/validlogin.php';
    ?>

    <!-- Seção geral  -->
    <section class="section-crud row">

        <!-- div Formulário -->
        <div class="col-md-6 col-sm-12 col-12 div-form">
            <? if(isset($_GET['edit'])){ ?>
            <h3><button title="Retornar ao Menu Principal" onclick="location.href='index.php';">Menu</button><span>Editar</span></h3>
            <? } else { ?>
            <h3><button title="Retornar ao Menu Principal" onclick="location.href='index.php';">Menu</button><span>Cadastrar</span></h3>
            <? } ?>

            <!-- Caso esteja realizando uma edição/update, carrega os dados necessários -->
            <?php
            if (isset($_GET['edit'])) {
                $codigo = $_GET['edit'];
                $query1 = "SELECT * FROM GENERIC WHERE GEN_CODE = '$codigo' ";
                $sql_edit1 = mysqli_query($conexao, $query1) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                $DATA_GEN = mysqli_fetch_array($sql_edit1);

                // $GEN_CODE = $DATA_GAL['GAL_GEN_CODE'];
                $query2 = "SELECT * FROM GALAXYS WHERE GAL_GEN_CODE = '$codigo' ";
                $sql_edit2 = mysqli_query($conexao, $query2) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                $DATA_GAL = mysqli_fetch_array($sql_edit2);
            }
            ?>

            <!-- Formulário de cadastro -->
            <form name="Cadastro" action="../cadastros/galaxys.php" method="POST">

                <!-- Se estiver editando/tualizando traz os dados do id -->
                <? if(isset($_GET['edit'])){ ?>
                <input type="number" hidden name='GEN_CODE' value="<?php echo $DATA_GEN['GEN_CODE'] ?>">
                <input type="number" hidden name='GAL_CODE' value="<?php echo $DATA_GAL['GAL_CODE'] ?>">
                <? } ?>

                <label>Nome </label>
                <input type="text" name="GEN_NAME" placeholder="Informe o nome da Galáxia" value="<?php echo $DATA_GEN['GEN_NAME'] ?>"><br>

                <label>Descrição </label>
                <textarea class="col-md-12" type="text" placeholder="Descreva detalhes da Galáxia" name="GEN_DESCRIPTION"><?php echo $DATA_GEN['GEN_DESCRIPTION'] ?></textarea><br>

                <label>Distância da Terra (em AL)</label>
                <input type="number" placeholder="Informe a distância da Galáxia com relação ao Planeta Terra" name="GEN_DISTANCE" value="<?php echo $DATA_GEN['GEN_DISTANCE'] ?>"><br>

                <label>Massa (em KG)</label>
                <input type="number" placeholder="Informe a massa da Galáxia" name="GEN_MASS" value="<?php echo $DATA_GEN['GEN_MASS'] ?>"><br>

                <label>Quantidade de Estrelas </label>
                <input type="number" placeholder="Informe a quantidade de estrelas" name="GAL_STARS" value="<?php echo $DATA_GAL['GAL_STARS'] ?>"><br>

                <label>Diâmetro (em AL)</label>
                <input type="number" placeholder="Informe o diâmetro da Galáxia" name="GAL_DIAMETER" value="<?php echo $DATA_GAL['GAL_DIAMETER'] ?>"><br>

                <label>Espessura (em AL)</label>
                <input type="number" placeholder="Informe a espessura da Galáxia" name="GAL_THICKNESS" value="<?php echo $DATA_GAL['GAL_THICKNESS'] ?>"><br><br>

                <!-- Opções do formulário -->
                <? if(!isset($_GET['edit'])){ ?>
                <input title="Salvar dados Inseridos" class="btn-form green" type="submit" name="enviar" value="Salvar">
                <input title="Limpar dados Inseridos" class="btn-form yellow" type="reset" name="reset" value="Limpar">
                <? } else { ?>
                <input title="Salvar dados Modificados" class="btn-form green" type="submit" name="edit" value="Atualizar">
                <input title="Limpar dados Inseridos" class="btn-form yellow" type="reset" name="reset" value="Limpar">
                <input title="Voltar para Galaxias" class="btn-form blue" type="button" onclick="location.href='galaxys.php';" value="Voltar">
                <? } ?>
            </form>

        </div>

        <!-- Dados Cadastrados -->
        <div class="col-md-6 col-sm-12 col-12 div-info">
            <h3>Galáxias Cadastradas</h3>
            <div class="table">
                <table>
                    <tr>
                        <th>NOME</th>
                        <th></th>
                    </tr>

                    <?php while ($data_info_gal = mysqli_fetch_assoc($sql_info_gal)) : ?>

                        <tr>
                            <td><?php echo $data_info_gal['GEN_NAME'] ?></td>
                            <!-- Botão para editar: envia (GET) para página php responsável por editar, o código do produto a ser recuperado apra edição -->
                            <td class="align-right">
                                <a title="Editar" href="galaxys.php?edit=<?php echo $data_info_gal['GEN_CODE'] ?>" onclick="return confirm('Deseja Editar <?php echo $data_info_gal['GEN_NAME'] ?>?');"><i class="fas fa-edit"></i></a>
                                <a class="a-delete" title="Deletar" href="../cadastros/galaxys.php?tabela_gal=GALAXYS&nomepk_gal=GAL_GEN_CODE&codigo_gal=<?php echo $data_info_gal['GEN_CODE'] ?>&tabela_gen=GENERIC&nomepk_gen=GEN_CODE&codigo_gen=<?php echo $data_info_gal['GEN_CODE'] ?>&origem=galaxys.php" onclick="return confirm('Deseja Excluir <?php echo $dados['GEN_NAME'] ?>?');"><i class="fas fa-trash-alt"></i></a>
                            </td>

                        </tr>

                    <?php endwhile; ?>

                </table>
            </div>
        </div>
    </section>
</body>

</html>