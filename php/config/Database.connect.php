<?php

include 'Database.config.php';

class Conexao
{
	public $connect;

	public function __construct() {
		$this->conectar();
	}

	public function conectar()
	{
		try {
			$this->connect = mysqli_connect($GLOBALS['config']['host'], $GLOBALS['config']['user'], $GLOBALS['config']['password'], $GLOBALS['config']['dbname']);
		
			if (!$this->connect) {
				throw new Exception("error na conexão");
			}
		} catch (Exception $e) {
			echo 'Resolver: ' .  $e;
		}
	}
}
