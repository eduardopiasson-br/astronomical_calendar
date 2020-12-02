<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Gerenciar Cometas</title>

    <!-- Css -->
    <link rel="stylesheet" href="../src/admin/css/styles.css">
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
    <?php
        ini_set('default_charset', 'UTF-8');

        error_reporting(0);
        include_once("../config/conectar.php");

        $query = 'SELECT GEN_NAME, GEN_CODE FROM GENERIC INNER JOIN COMETS ON GENERIC.GEN_CODE = COMETS.COM_GEN_CODE;';
        $sql_info_obj = mysqli_query($conexao, $query) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
        
        $query2 = 'SELECT GENERIC.GEN_NAME, GENERIC.GEN_CODE, GALAXYS.GAL_CODE FROM GENERIC, GALAXYS WHERE GENERIC.GEN_CODE = GALAXYS.GAL_GEN_CODE;';
        $sql_info_associated = mysqli_query($conexao, $query2) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));

        include_once 'login/validlogin.php';
    ?>
    <section class="section-crud">
        <!-- Formulário -->
        <div class="col-md-6 div-form">
            <? if(isset($_GET['edit'])){ ?>
                <h3><button title="Retornar ao Menu Principal" onclick="location.href='index.php';">Menu</button>Editar</h3>
            <? } else { ?>
                <h3><button title="Retornar ao Menu Principal" onclick="location.href='index.php';">Menu</button>Cadastrar</h3>
            <? } ?>
            <?php
                if (isset($_GET['edit'])) {
                    $codigo = $_GET['edit'];
                    $query1 = "SELECT * FROM GENERIC WHERE GEN_CODE = '$codigo' ";
                    $sql_edit1 = mysqli_query($conexao, $query1) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                    $DATA_GEN = mysqli_fetch_array($sql_edit1);

                    $query2 = "SELECT * FROM COMETS WHERE COM_GEN_CODE = '$codigo' ";
                    $sql_edit2 = mysqli_query($conexao, $query2) or die('ERRO - Não foi possível executar a Query: ' . mysqli_error($conexao));
                    $DATA_OBJ = mysqli_fetch_array($sql_edit2);

                }
            ?>
            <form id="comets" name="Cadastro" action="../cadastros/comets.php" method="POST">
                <? if(isset($_GET['edit'])){ ?>
                    <input type="number" hidden name='GEN_CODE' value="<?php echo $DATA_GEN['GEN_CODE'] ?>">
                    <input type="number" hidden name='COM_CODE' value="<?php echo $DATA_OBJ['COM_CODE'] ?>">
                <? } ?>
                    <label>Nome </label>
                    <input type="text" name="GEN_NAME" placeholder="Informe o nome do Sistema" value="<?php echo $DATA_GEN['GEN_NAME'] ?>"><br>
                    <label>Descrição </label>
                    <textarea class="col-md-12" type="text" placeholder="Descreva detalhes do Sistema" name="GEN_DESCRIPTION"><?php echo $DATA_GEN['GEN_DESCRIPTION'] ?></textarea><br>
                    <label>Distância da Terra </label>
                    <input type="NUMBER" placeholder="Informe a distância do Sistema com relação ao Planeta Terra" name="GEN_DISTANCE" value="<?php echo $DATA_GEN['GEN_DISTANCE'] ?>"><br>
                    <label>Massa </label>
                    <input type="NUMBER" placeholder="Informe a massa do Sistema" name="GEN_MASS" value="<?php echo $DATA_GEN['GEN_MASS'] ?>"><br>
                    <label>Data da Descoberta</label>
                    <input type="date" placeholder="Informe o tempo de uma rotação completa" name="COM_DISCOVERY" value="<?php echo $DATA_OBJ['COM_DISCOVERY'] ?>"><br>

                    <select class="select-form" name="COM_GAL_CODE" id="COM_GAL_CODE" form="comets" required>
                        <option value="">Selecione uma galáxia de origem</option>
                        <option value="0" <?php if(!empty($DATA_OBJ['COM_CODE']) && is_null($DATA_OBJ['COM_GAL_CODE'])) {?> selected <?php } ?>>Galáxia de origem não cadastrada</option>                                        
                        <?php while ($associated = mysqli_fetch_assoc($sql_info_associated)) : ?>
                            <option <? if($DATA_OBJ['COM_GAL_CODE'] == $associated['GAL_CODE']) { ?> selected <? } ?> title="<?php echo $associated['GEN_NAME'] ?>" value="<?php echo $associated['GAL_CODE'] ?>"><?php echo $associated['GAL_CODE'] ?> - <?php echo $associated['GEN_NAME'] ?></option>                    
                        <?php endwhile; ?>
                    </select>
                    <br>
                <? if(!isset($_GET['edit'])){ ?>
                    <input title="Salvar dados Inseridos" class="btn-form green" type="submit" name="enviar" value="Salvar">
                    <input title="Limpar dados Inseridos" class="btn-form yellow" type="reset" name="reset" value="Limpar">
                <? } else { ?>
                    <input title="Salvar dados Modificados" class="btn-form green" type="submit" name="edit" value="Atualizar">
                    <input title="Limpar dados Inseridos" class="btn-form yellow" type="reset" name="reset" value="Limpar">
                    <input title="Voltar para Sistemas" class="btn-form blue" type="button" onclick="location.href='comets.php';" value="Voltar">
                <? } ?>
            </form>

        </div>

        <!-- Dados Cadastrados -->
        <div class="col-md-6 div-info">
            <h3>Cometas Cadastrados</h3>
            <div class="table">
                <table>
                    <tr>
                        <th>NOME</th>
                        <th></th>
                    </tr>

                    <?php while ($object = mysqli_fetch_assoc($sql_info_obj)) : ?>

                        <tr>
                            <td><?php echo $object['GEN_NAME'] ?></td>
                            <!-- Botão para editar: envia (GET) para página php responsável por editar, o código do produto a ser recuperado apra edição -->
                            <td class="align-right">
                                <a title="Editar" href="comets.php?edit=<?php echo $object['GEN_CODE'] ?>" onclick="return confirm('Deseja Editar <?php echo $object['GEN_NAME'] ?>?');"><i class="fas fa-edit"></i></a>
                                <a class="a-delete" title="Deletar" href="../cadastros/comets.php?tabela_obj=COMETS&nomepk_obj=COM_GEN_CODE&codigo_obj=<?php echo $object['GEN_CODE'] ?>&tabela_gen=GENERIC&nomepk_gen=GEN_CODE&codigo_gen=<?php echo $object['GEN_CODE'] ?>&origem=comets.php" onclick="return confirm('Deseja Excluir <?php echo $object['GEN_NAME'] ?>?');"><i class="fas fa-trash-alt"></i></a>
                            </td>

                        </tr>

                    <?php endwhile; ?>

                </table>
            </div>
        </div>
    </section>
</body>

</html>
