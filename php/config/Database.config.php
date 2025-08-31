<?php 
	$GLOBALS['config'] =  array();

	// conexão com banco de dados MYSQL
	$config['host'] = '192.168.200.109';
	$config['user'] = 'gonsul';
	$config['password'] = 'd]HBJhIuGn3Lfol(';
	$config['dbname'] = 'controle_sist_v1';
	
	//paginacao, quantidade de itens a ser mostrado.
	$GLOBALS['config']['quantidade_registros'] =  15;

	// Variavel de Quilometragem troca de óleo, para sugerir aproxima troca de óleo.
	$GLOBALS['config']['kilometragem_troca_de_oleo'] = 20.000;
