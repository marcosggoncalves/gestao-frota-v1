<?php

function salvar_categoria($POST)
{
	$salvar_categoria = $GLOBALS['Recursos']->Query($GLOBALS['inserts']->salvar_categoria($POST));
	try {
		if (!$salvar_categoria) {
			throw new Exception("Não foi possivel registrar categoria.");
		}
		$_SESSION["msg"] = 'Categoria cadastrada com sucesso.';
		header('Location: ../pages/forms/cadastrar_categoria');
	} catch (Exception $e) {
		$_SESSION["msg"] = $e;
		header('Location: ../pages/forms/cadastrar_categoria');
	}
}
