<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Gerenciar Lançamentos</title>

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

    $query = 'SELECT * FROM RELEASES;';
    $sql_info_obj = mysqli_query($conexao, $query) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query2 = 'SELECT * FROM PHENOMENA;';
    $sql_info_phenomena = mysqli_query($conexao, $query2) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query3 = 'SELECT * FROM MISSIONS;';
    $sql_info_missions = mysqli_query($conexao, $query3) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));


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
                $query_releases = "SELECT * FROM RELEASES WHERE REL_CODE = '$codigo' ";
                $sql_releases = mysqli_query($conexao, $query_releases) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                $DATA_REL = mysqli_fetch_array($sql_releases);

                $query_mission = "SELECT * FROM RELEASE_MISSION WHERE REM_REL_CODE = '$codigo' ";
                $sql_edit_mission = mysqli_query($conexao, $query_mission) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                $DATA_REM = mysqli_fetch_array($sql_edit_mission);

                $query_phenomena = "SELECT * FROM RELEASE_PHENOMENA WHERE REP_REL_CODE = '$codigo' ";
                $sql_edit_phenomena = mysqli_query($conexao, $query_phenomena) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                $DATA_REP = mysqli_fetch_array($sql_edit_phenomena);
            }
            ?>

            <!-- Formulário de cadastro -->
            <form id="releases" name="Cadastro" action="../cadastros/releases.php" method="POST">

                <!-- Se estiver editando/tualizando traz os dados do id -->
                <? if(isset($_GET['edit'])){ ?>
                <input type="number" hidden name='REL_CODE' value="<?php echo $DATA_REL['REL_CODE'] ?>">
                <? } ?>

                <label>Nome </label>
                <input type="col-md-12text" name="REL_NAME" placeholder="Informe um nome para o Lançamento" value="<?php echo $DATA_REL['REL_NAME'] ?>"><br>

                <label>Companhia </label>
                <input class="col-md-12" type="text" placeholder="Informe a companhia que realizará o lançamento" name="REL_COMPANY" value="<?php echo $DATA_REL['REL_COMPANY'] ?>"><br>

                <label>Local </label>
                <input class="col-md-12" type="text" placeholder="Informe o Local do Lançamento" name="REL_LOCAL" value="<?php echo $DATA_REL['REL_LOCAL'] ?>"><br>

                <label>Destino </label>
                <input class="col-md-12" type="text" placeholder="Informe o local de destino" name="REL_DESTINY" value="<?php echo $DATA_REL['REL_DESTINY'] ?>"><br>

                <label>Descrição </label>
                <textarea class="col-md-12" type="text" placeholder="Descreva detalhes do lançamento" name="REL_DESCRIPTION"><?php echo $DATA_REL['REL_DESCRIPTION'] ?></textarea><br>

                <label>Data que ocorrerá </label>
                <input type="date" placeholder="Informe a data que acontecerá o Lançamento" name="REL_DATE" value="<?php echo $DATA_REL['REL_DATE'] ?>"><br>

                <label>Caso o Lançamento esteja associado a alguma missão ou fenômeno, selecione abaixo</label>

                <!-- Combobox das missões -->
                <select class="select-form col-md-6 col-sm-12 col-12" name="REM_MIS_CODE" id="REM_MIS_CODE" form="releases">
                    <option value="0">Selecione uma Missão</option>
                    <?php while ($missions = mysqli_fetch_assoc($sql_info_missions)) : ?>
                        <option <? if($DATA_REM['REM_MIS_CODE']==$missions['MIS_CODE']) { ?> selected
                            <? } ?> title="<?php echo $missions['MIS_NAME'] ?>" value="<?php echo $missions['MIS_CODE'] ?>"><?php echo $missions['MIS_CODE'] ?> - <?php echo $missions['MIS_NAME'] ?></option>
                    <?php endwhile; ?>
                </select>

                <!-- Combobox dos fenômenos -->
                <select class="select-form col-md-6 col-sm-12 col-12" name="REP_PHE_CODE" id="REP_PHE_CODE" form="releases">
                    <option value="0">Selecione um Fenômeno</option>
                    <?php while ($phenomena = mysqli_fetch_assoc($sql_info_phenomena)) : ?>
                        <option <? if($DATA_REP['REP_PHE_CODE']==$phenomena['PHE_CODE']) { ?> selected
                            <? } ?> title="<?php echo $phenomena['PHE_NAME'] ?>" value="<?php echo $phenomena['PHE_CODE'] ?>"><?php echo $phenomena['PHE_CODE'] ?> - <?php echo $phenomena['PHE_NAME'] ?></option>
                    <?php endwhile; ?>
                </select><br>

                <!-- Opções do formulário -->
                <? if(!isset($_GET['edit'])){ ?>
                <input title="Salvar dados Inseridos" class="btn-form green" type="submit" name="enviar" value="Salvar">
                <input title="Limpar dados Inseridos" class="btn-form yellow" type="reset" name="reset" value="Limpar">
                <? } else { ?>
                <input title="Salvar dados Modificados" class="btn-form green" type="submit" name="edit" value="Atualizar">
                <input title="Limpar dados Inseridos" class="btn-form yellow" type="reset" name="reset" value="Limpar">
                <input title="Voltar para Lançamentos" class="btn-form blue" type="button" onclick="location.href='releases.php';" value="Voltar">
                <? } ?>
            </form>

        </div>

        <!-- Dados Cadastrados -->
        <div class="col-md-6 div-info">
            <h3>Lançamentos Cadastrados</h3>
            <div class="table">
                <table>
                    <tr>
                        <th>NOME</th>
                        <th></th>
                    </tr>

                    <?php while ($releases = mysqli_fetch_assoc($sql_info_obj)) : ?>

                        <tr>
                            <td><?php echo $releases['REL_NAME'] ?></td>
                            <!-- Botão para editar: envia (GET) para página php responsável por editar, o código do produto a ser recuperado apra edição -->
                            <td class="align-right">
                                <a title="Editar" href="releases.php?edit=<?php echo $releases['REL_CODE'] ?>" onclick="return confirm('Deseja Editar <?php echo $releases['REL_NAME'] ?>?');"><i class="fas fa-edit"></i></a>
                                <a class="a-delete" title="Deletar" href="../cadastros/releases.php?tabela_rel=RELEASES&nomepk_rel=REL_CODE&codigo_rel=<?php echo $releases['REL_CODE'] ?>&origem=releases.php" onclick="return confirm('Deseja Excluir <?php echo $releases['REL_NAME'] ?>?');"><i class="fas fa-trash-alt"></i></a>
                            </td>

                        </tr>

                    <?php endwhile; ?>

                </table>
            </div>
        </div>
    </section>
</body>

</html>