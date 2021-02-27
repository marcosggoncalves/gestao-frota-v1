<?php 
	$GLOBALS['config'] =  array();



	// conexão com banco de dados MYSQL

	

	$config['host'] = 'localhost';
	$config['user'] = 'root';
	$config['password'] = '';
	$config['dbname'] = 'controle_sist';
	
	//Paginação, quantidade de itens a ser mostrado.

	$GLOBALS['config']['quantidade_registros'] =  15;


	// Variavel de Quilometragem troca de óleo, para sugerir aproxima troca de óleo.
	

	$GLOBALS['config']['kilometragem_troca_de_oleo'] = 20.000;

 ?>
