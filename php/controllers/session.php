<?php

function validar_session()
{
	if (!isset($_SESSION["logado"]) || $_SESSION["logado"] != TRUE) {
		$_SESSION["msg"] = 'Acesse sua conta novamente.';
		header("Location: ../../index");
	}
	if (!isset($_SESSION)) {
		session_start();
	}

	$timeout = 280;
	if (isset($_SESSION['timeout'])) {
		$duration = time() - (int)$_SESSION['timeout'];
		if ($duration > $timeout) {
			session_destroy();
			session_start();
			$_SESSION["msg"] = 'Acesse sua conta novamente, sessão expirada';
			header("Location: ../../index");
		}
	}
	$_SESSION['timeout'] = time();
}
function mostrar_login()
{
	return $_SESSION['user']['nome_usuario'] . ' -  Setor' . $_SESSION['user']['setor_usuario'];
}
function acessar($POST)
{
	$GLOBALS['Recursos']->login($GLOBALS['Recursos']->query($GLOBALS['selects']->logar_user($POST)), function ($dados) {
		if ($dados[6] == 'Desativado') {
			$_SESSION["msg"] = $dados[1] . ', sua conta está desativado, por favor contate o setor responsável pela administração do sistema.';
			header('Location: ../index');
		} else {
			$_SESSION['user'] = $dados;
			$_SESSION['logado'] = TRUE;
			header('Location: ../pages/relatorios/painel');
		}
	}, function () {
		header('Location: ../index');
		$_SESSION["msg"] = 'Tente acessar novamente, dados incorretos !!!';
	});
}
function finalizar_sessao()
{
	session_destroy();
	session_start();
	$_SESSION["msg"] = 'Sessão finalizada com sucesso.';
	header('Location: ../index');
}
