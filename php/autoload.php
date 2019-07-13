<?php 


	session_start();
	
	// includes
	include 'recursos.php';
	include 'models/Selects.php';
	include 'models/Inserts.php';
	include 'models/Updates.php';
	include 'models/Deletes.php';


	//controllers
	include 'controllers/session.php';
	include 'controllers/painel.php';
	include 'controllers/saida_manuntencao.php';
	include 'controllers/troca_oleo.php';
	include 'controllers/retirada_produto.php';
	include 'controllers/veiculos.php';
	include 'controllers/categoria.php';
	include 'controllers/produto.php';
	include 'controllers/usuario.php';
	include 'controllers/filtros.php';

	// autoload Model
	$GLOBALS['selects'] = new selects();
	$GLOBALS['updates'] = new updates();
	$GLOBALS['inserts'] = new inserts();	
	$GLOBALS['deletes'] = new deletes();	


	// Recursos Globais
	$GLOBALS['Recursos'] = new Recursos();


 ?>