<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Gerenciar Fenômenos</title>

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

    $query = 'SELECT * FROM PHENOMENA;';
    $sql_info_obj = mysqli_query($conexao, $query) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query2 = 'SELECT GENERIC.GEN_NAME, GENERIC.GEN_CODE, GALAXYS.GAL_CODE FROM GENERIC, GALAXYS WHERE GENERIC.GEN_CODE = GALAXYS.GAL_GEN_CODE;';
    $sql_info_galaxys = mysqli_query($conexao, $query2) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query3 = 'SELECT GENERIC.GEN_NAME, GENERIC.GEN_CODE, SYSTEMS.SYS_CODE FROM GENERIC, SYSTEMS WHERE GENERIC.GEN_CODE = SYSTEMS.SYS_GEN_CODE;';
    $sql_info_systems = mysqli_query($conexao, $query3) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query4 = 'SELECT GENERIC.GEN_NAME, GENERIC.GEN_CODE, STARS.STA_CODE FROM GENERIC, STARS WHERE GENERIC.GEN_CODE = STARS.STA_GEN_CODE;';
    $sql_info_stars = mysqli_query($conexao, $query4) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query5 = 'SELECT GENERIC.GEN_NAME, GENERIC.GEN_CODE, PLANETS.PLA_CODE FROM GENERIC, PLANETS WHERE GENERIC.GEN_CODE = PLANETS.PLA_GEN_CODE;';
    $sql_info_planets = mysqli_query($conexao, $query5) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query6 = 'SELECT GENERIC.GEN_NAME, GENERIC.GEN_CODE, SATELLITES.SAT_CODE FROM GENERIC, SATELLITES WHERE GENERIC.GEN_CODE = SATELLITES.SAT_GEN_CODE;';
    $sql_info_satellites = mysqli_query($conexao, $query6) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

    $query7 = 'SELECT GENERIC.GEN_NAME, GENERIC.GEN_CODE, COMETS.COM_CODE FROM GENERIC, COMETS WHERE GENERIC.GEN_CODE = COMETS.COM_GEN_CODE;';
    $sql_info_comets = mysqli_query($conexao, $query7) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

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
                $query_phenomena = "SELECT * FROM PHENOMENA WHERE PHE_CODE = '$codigo' ";
                $sql_phenomena = mysqli_query($conexao, $query_phenomena) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                $DATA_PHE = mysqli_fetch_array($sql_phenomena);

                $query_galaxy = "SELECT * FROM PHENOMENA_GALAXYS WHERE PHG_PHE_CODE = '$codigo' ";
                $sql_edit_galaxy = mysqli_query($conexao, $query_galaxy) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                $DATA_PHG = mysqli_fetch_array($sql_edit_galaxy);

                $query_systems = "SELECT * FROM PHENOMENA_SYSTEMS WHERE PHS_PHE_CODE = '$codigo' ";
                $sql_edit_systems = mysqli_query($conexao, $query_systems) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                $DATA_PHS = mysqli_fetch_array($sql_edit_systems);

                $query_stars = "SELECT * FROM PHENOMENA_STARS WHERE PST_PHE_CODE = '$codigo' ";
                $sql_edit_stars = mysqli_query($conexao, $query_stars) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                $DATA_PST = mysqli_fetch_array($sql_edit_stars);

                $query_planets = "SELECT * FROM PHENOMENA_PLANETS WHERE PHP_PHE_CODE = '$codigo' ";
                $sql_edit_planets = mysqli_query($conexao, $query_planets) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                $DATA_PHP = mysqli_fetch_array($sql_edit_planets);

                $query_satellites = "SELECT * FROM PHENOMENA_SATELLITES WHERE PSA_PHE_CODE = '$codigo' ";
                $sql_edit_satellites = mysqli_query($conexao, $query_satellites) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                $DATA_PSA = mysqli_fetch_array($sql_edit_satellites);

                $query_comets = "SELECT * FROM PHENOMENA_COMETS WHERE PHC_PHE_CODE = '$codigo' ";
                $sql_edit_comets = mysqli_query($conexao, $query_comets) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                $DATA_PHC = mysqli_fetch_array($sql_edit_comets);
            }
            ?>

            <!-- Formulário de cadastro -->
            <form id="phenomena" name="Cadastro" action="../cadastros/phenomena.php" method="POST">

                <!-- Se estiver editando/tualizando traz os dados do id -->
                <? if(isset($_GET['edit'])){ ?>
                <input type="number" hidden name='PHE_CODE' value="<?php echo $DATA_PHE['PHE_CODE'] ?>">
                <? } ?>

                <label>Nome </label>
                <input type="text" name="PHE_NAME" placeholder="Informe um nome para o Fenômeno" value="<?php echo $DATA_PHE['PHE_NAME'] ?>"><br>

                <label>Descrição </label>
                <textarea class="col-md-12" type="text" placeholder="Descreva detalhes do Fenômeno" name="PHE_DESCRIPTION"><?php echo $DATA_PHE['PHE_DESCRIPTION'] ?></textarea><br>

                <label>Data que ocorrerá </label>
                <input type="date" placeholder="Informe a data que acontecerá o Fenômeno" name="PHE_DATE" value="<?php echo $DATA_PHE['PHE_DATE'] ?>"><br>

                <label>Caso o fenômeno esteja associado a algum endereço cósmico, selecione-os nas opções abaixo </label>

                <!-- Combobox das galáxias -->
                <select class="select-form col-md-6 col-sm-12 col-12" name="PHG_GAL_CODE" id="PHG_GAL_CODE" form="phenomena">
                    <option value="0">Selecione uma Galáxia</option>
                    <?php while ($galaxys = mysqli_fetch_assoc($sql_info_galaxys)) : ?>
                        <option <? if($DATA_PHG['PHG_GAL_CODE']==$galaxys['GAL_CODE']) { ?> selected
                            <? } ?> title="<?php echo $galaxys['GEN_NAME'] ?>" value="<?php echo $galaxys['GAL_CODE'] ?>"><?php echo $galaxys['GAL_CODE'] ?> - <?php echo $galaxys['GEN_NAME'] ?></option>
                    <?php endwhile; ?>
                </select>

                <!-- Combobox dos sistemas -->
                <select class="select-form col-md-6 col-sm-12 col-12" name="PHS_SYS_CODE" id="PHS_SYS_CODE" form="phenomena">
                    <option value="0">Selecione um Sistema</option>
                    <?php while ($systems = mysqli_fetch_assoc($sql_info_systems)) : ?>
                        <option <? if($DATA_PHS['PHS_SYS_CODE']==$systems['SYS_CODE']) { ?> selected
                            <? } ?> title="<?php echo $systems['GEN_NAME'] ?>" value="<?php echo $systems['SYS_CODE'] ?>"><?php echo $systems['SYS_CODE'] ?> - <?php echo $systems['GEN_NAME'] ?></option>
                    <?php endwhile; ?>
                </select>

                <!-- Combobox das estrelas -->
                <select class="select-form col-md-6 col-sm-12 col-12" name="PST_STA_CODE" id="PST_STA_CODE" form="phenomena">
                    <option value="0">Selecione uma Estrela</option>
                    <?php while ($stars = mysqli_fetch_assoc($sql_info_stars)) : ?>
                        <option <? if($DATA_PST['PST_STA_CODE']==$stars['STA_CODE']) { ?> selected
                            <? } ?> title="<?php echo $stars['GEN_NAME'] ?>" value="<?php echo $stars['STA_CODE'] ?>"><?php echo $stars['STA_CODE'] ?> - <?php echo $stars['GEN_NAME'] ?></option>
                    <?php endwhile; ?>
                </select>

                <!-- Combobox dos planetas -->
                <select class="select-form col-md-6 col-sm-12 col-12" name="PHP_PLA_CODE" id="PHP_PLA_CODE" form="phenomena">
                    <option value="0">Selecione um Planeta</option>
                    <?php while ($planets = mysqli_fetch_assoc($sql_info_planets)) : ?>
                        <option <? if($DATA_PHP['PHP_PLA_CODE']==$planets['PLA_CODE']) { ?> selected
                            <? } ?> title="<?php echo $planets['GEN_NAME'] ?>" value="<?php echo $planets['PLA_CODE'] ?>"><?php echo $planets['PLA_CODE'] ?> - <?php echo $planets['GEN_NAME'] ?></option>
                    <?php endwhile; ?>
                </select>

                <!-- Combobox dos satélites naturais -->
                <select class="select-form col-md-6 col-sm-12 col-12" name="PSA_SAT_CODE" id="PSA_SAT_CODE" form="phenomena">
                    <option value="0">Selecione um Satélite Natural</option>
                    <?php while ($satellites = mysqli_fetch_assoc($sql_info_satellites)) : ?>
                        <option <? if($DATA_PSA['PSA_SAT_CODE']==$satellites['SAT_CODE']) { ?> selected
                            <? } ?> title="<?php echo $satellites['GEN_NAME'] ?>" value="<?php echo $satellites['SAT_CODE'] ?>"><?php echo $satellites['SAT_CODE'] ?> - <?php echo $satellites['GEN_NAME'] ?></option>
                    <?php endwhile; ?>
                </select>

                <!-- Combobox dos cometas -->
                <select class="select-form col-md-6 col-sm-12 col-12" name="PHC_COM_CODE" id="PHC_COM_CODE" form="phenomena">
                    <option value="0">Selecione um Cometa</option>
                    <?php while ($comets = mysqli_fetch_assoc($sql_info_comets)) : ?>
                        <option <? if($DATA_PHC['PHC_COM_CODE']==$comets['COM_CODE']) { ?> selected
                            <? } ?> title="<?php echo $comets['GEN_NAME'] ?>" value="<?php echo $comets['COM_CODE'] ?>"><?php echo $comets['COM_CODE'] ?> - <?php echo $comets['GEN_NAME'] ?></option>
                    <?php endwhile; ?>
                </select><br>

                <!-- Opções do formulário -->
                <? if(!isset($_GET['edit'])){ ?>
                <input title="Salvar dados Inseridos" class="btn-form green" type="submit" name="enviar" value="Salvar">
                <input title="Limpar dados Inseridos" class="btn-form yellow" type="reset" name="reset" value="Limpar">
                <? } else { ?>
                <input title="Salvar dados Modificados" class="btn-form green" type="submit" name="edit" value="Atualizar">
                <input title="Limpar dados Inseridos" class="btn-form yellow" type="reset" name="reset" value="Limpar">
                <input title="Voltar para Fenômenos" class="btn-form blue" type="button" onclick="location.href='phenomena.php';" value="Voltar">
                <? } ?>
            </form>

        </div>

        <!-- Dados Cadastrados -->
        <div class="col-md-6 div-info">
            <h3>Fenômenos Cadastrados</h3>
            <div class="table">
                <table>
                    <tr>
                        <th>NOME</th>
                        <th></th>
                    </tr>

                    <?php while ($phenomena = mysqli_fetch_assoc($sql_info_obj)) : ?>

                        <tr>
                            <td><?php echo $phenomena['PHE_NAME'] ?></td>
                            <!-- Botão para editar: envia (GET) para página php responsável por editar, o código do produto a ser recuperado apra edição -->
                            <td class="align-right">
                                <a title="Editar" href="phenomena.php?edit=<?php echo $phenomena['PHE_CODE'] ?>" onclick="return confirm('Deseja Editar <?php echo $phenomena['PHE_NAME'] ?>?');"><i class="fas fa-edit"></i></a>
                                <a class="a-delete" title="Deletar" href="../cadastros/phenomena.php?tabela_phe=PHENOMENA&nomepk_phe=PHE_CODE&codigo_phe=<?php echo $phenomena['PHE_CODE'] ?>&origem=phenomena.php" onclick="return confirm('Deseja Excluir <?php echo $phenomena['PHE_NAME'] ?>?');"><i class="fas fa-trash-alt"></i></a>
                            </td>

                        </tr>

                    <?php endwhile; ?>

                </table>
            </div>
        </div>
    </section>
</body>

</html>