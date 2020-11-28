<?php
	$servidor_bd = "127.0.0.1";
	$usuario_bd = "root";
	$senha_bd = "";
	$nome_bd = "astronomical-calendar";
	//Criando a conexão com o banco de dados
	$conexao = mysqli_connect($servidor_bd, $usuario_bd, $senha_bd, $nome_bd);
	//Verificando a conexão
	if (!$conexao) {
		die("Erro: não foi possível conectar ao banco de dados! Detalhes: " . mysqli_connect_error());
		//die é equivalente a exit()
	}
	//Especificando o charset do banco
	mysqli_set_charset($conexao,'utf8');
?>