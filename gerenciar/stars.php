<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Gerenciar Estrelas</title>

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

    // $query = 'SELECT * FROM GENERIC;';
    // $sql_info_gen = mysqli_query($conexao, $query) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query = 'SELECT GEN_NAME, GEN_CODE FROM GENERIC INNER JOIN STARS ON GENERIC.GEN_CODE = STARS.STA_GEN_CODE;';
    $sql_info_obj = mysqli_query($conexao, $query) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query2 = 'SELECT GENERIC.GEN_NAME, GENERIC.GEN_CODE, SYSTEMS.SYS_CODE FROM GENERIC, SYSTEMS WHERE GENERIC.GEN_CODE = SYSTEMS.SYS_GEN_CODE;';
    $sql_info_associated = mysqli_query($conexao, $query2) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    include_once 'login/validlogin.php';
    ?>

    <!-- Seção geral  -->
    <section class="section-crud">

        <!-- div Formulário -->
        <div class="col-md-6 div-form">
            <? if(isset($_GET['edit'])){ ?>
            <h3><button title="Retornar ao Menu Principal" onclick="location.href='index.php';">Menu</button>Editar</h3>
            <? } else { ?>
            <h3><button title="Retornar ao Menu Principal" onclick="location.href='index.php';">Menu</button>Cadastrar</h3>
            <? } ?>

            <!-- Caso esteja realizando uma edição/update, carrega os dados necessários -->
            <?php
            if (isset($_GET['edit'])) {
                $codigo = $_GET['edit'];
                $query1 = "SELECT * FROM GENERIC WHERE GEN_CODE = '$codigo' ";
                $sql_edit1 = mysqli_query($conexao, $query1) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                $DATA_GEN = mysqli_fetch_array($sql_edit1);

                $query2 = "SELECT * FROM STARS WHERE STA_GEN_CODE = '$codigo' ";
                $sql_edit2 = mysqli_query($conexao, $query2) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                $DATA_OBJ = mysqli_fetch_array($sql_edit2);
            }
            ?>

            <!-- Formulário de cadastro -->
            <form id="stars" name="Cadastro" action="../cadastros/stars.php" method="POST">

                <!-- Se estiver editando/tualizando traz os dados do id -->
                <? if(isset($_GET['edit'])){ ?>
                <input type="number" hidden name='GEN_CODE' value="<?php echo $DATA_GEN['GEN_CODE'] ?>">
                <input type="number" hidden name='STA_CODE' value="<?php echo $DATA_OBJ['STA_CODE'] ?>">
                <? } ?>

                <label>Nome </label>
                <input type="text" name="GEN_NAME" placeholder="Informe o nome do Estrela" value="<?php echo $DATA_GEN['GEN_NAME'] ?>"><br>

                <label>Descrição </label>
                <textarea class="col-md-12" type="text" placeholder="Descreva detalhes do Estrela" name="GEN_DESCRIPTION"><?php echo $DATA_GEN['GEN_DESCRIPTION'] ?></textarea><br>

                <label>Distância da Terra (em AL) </label>
                <input type="NUMBER" placeholder="Informe a distância do Estrela com relação ao Planeta Terra" name="GEN_DISTANCE" value="<?php echo $DATA_GEN['GEN_DISTANCE'] ?>"><br>

                <label>Massa (em Kg) </label>
                <input type="NUMBER" placeholder="Informe a massa do Estrela" name="GEN_MASS" value="<?php echo $DATA_GEN['GEN_MASS'] ?>"><br>

                <label>Tipo/Cor </label>
                <input type="text" placeholder="Informe o tipo/cor" name="STA_COLOR" value="<?php echo $DATA_OBJ['STA_COLOR'] ?>"><br>

                <!-- Dados de tabela associada -->
                <select class="select-form" name="STA_SYS_CODE" id="STA_SYS_CODE" form="stars" required>
                    <option value="">Selecione um Sistema</option>
                    <option value="0" <?php if (!empty($DATA_OBJ['STA_CODE']) && is_null($DATA_OBJ['STA_SYS_CODE'])) { ?> selected <?php } ?>>Sistema não cadastrado</option>
                    <?php while ($associated = mysqli_fetch_assoc($sql_info_associated)) : ?>
                        <option <? if($DATA_OBJ['STA_SYS_CODE']==$associated['SYS_CODE']) { ?> selected
                            <? } ?> title="<?php echo $associated['GEN_NAME'] ?>" value="<?php echo $associated['SYS_CODE'] ?>"><?php echo $associated['SYS_CODE'] ?> - <?php echo $associated['GEN_NAME'] ?></option>
                    <?php endwhile; ?>
                </select><br>

                <!-- Opções do formulário -->
                <? if(!isset($_GET['edit'])){ ?>
                <input title="Salvar dados Inseridos" class="btn-form green" type="submit" name="enviar" value="Salvar">
                <input title="Limpar dados Inseridos" class="btn-form yellow" type="reset" name="reset" value="Limpar">
                <? } else { ?>
                <input title="Salvar dados Modificados" class="btn-form green" type="submit" name="edit" value="Atualizar">
                <input title="Limpar dados Inseridos" class="btn-form yellow" type="reset" name="reset" value="Limpar">
                <input title="Voltar para Sistemas" class="btn-form blue" type="button" onclick="location.href='stars.php';" value="Voltar">
                <? } ?>
            </form>

        </div>

        <!-- Dados Cadastrados -->
        <div class="col-md-6 div-info">
            <h3>Estrelas Cadastradas</h3>
            <div class="table">
                <table>
                    <tr>
                        <th>NOME</th>
                        <th></th>
                    </tr>

                    <?php while ($obj = mysqli_fetch_assoc($sql_info_obj)) : ?>

                        <tr>
                            <td><?php echo $obj['GEN_NAME'] ?></td>
                            <!-- Botão para editar: envia (GET) para página php responsável por editar, o código do produto a ser recuperado apra edição -->
                            <td class="align-right">
                                <a title="Editar" href="stars.php?edit=<?php echo $obj['GEN_CODE'] ?>" onclick="return confirm('Deseja Editar <?php echo $obj['GEN_NAME'] ?>?');"><i class="fas fa-edit"></i></a>
                                <a class="a-delete" title="Deletar" href="../cadastros/stars.php?tabela_sys=stars&nomepk_sys=STA_GEN_CODE&codigo_sys=<?php echo $obj['GEN_CODE'] ?>&tabela_gen=GENERIC&nomepk_gen=GEN_CODE&codigo_gen=<?php echo $obj['GEN_CODE'] ?>&origem=stars.php" onclick="return confirm('Deseja Excluir <?php echo $obj['GEN_NAME'] ?>?');"><i class="fas fa-trash-alt"></i></a>
                            </td>

                        </tr>

                    <?php endwhile; ?>

                </table>
            </div>
        </div>
    </section>
</body>

</html>