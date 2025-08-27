<?php
function validar_acesso_page_manutencao()
{
	if (!isset($_SESSION["manutencao"])) {
		$_SESSION["msg"] = 'Não é possivel acessar página.';
		header("Location: ../../pages/relatorios/relatorio_filtro");
	}
}
function veiculos_status($camada, $categoria, $busca)
{
	if ($busca == 'Todos') {
		$GLOBALS['Recursos']->fetch_array($GLOBALS['Recursos']->query($GLOBALS['selects']->all_veiculos_disponiveis()), function ($dados) {
			echo "<option value=" . $dados[1] . ">" . $dados[0] . '(' . $dados[6] . ')' . "</option>";
		});
	} else {
		$GLOBALS['Recursos']->fetch_array($GLOBALS['Recursos']->query($GLOBALS['selects']->veiculos_status('Disponivel', $categoria)), function ($dados, $camada) {
			if ($camada > 0) {
				echo "<option value=" . $dados[1] . ">" . $dados[0] . "</option>";
			} else {
				echo "<option value=" . $dados[0] . ">" . $dados[0] . "</option>";
			}
		});
	}
}
function salvar_manutencao($POST)
{

	$insert_manutencao = $GLOBALS['Recursos']->query($GLOBALS['inserts']->salvar_manutencao($POST));

	$update_veiculo =  $GLOBALS['Recursos']->query($GLOBALS['updates']->mudar_status_veiculo_via_id('Indisponivel', $POST['id_veiculo']));

	if ($POST["placa_veiculo"] != 'Veiculo não substituido') {
		$update_veiculo_sub =  $GLOBALS['Recursos']->query($GLOBALS['updates']->mudar_status_veiculo_via_placa('Indisponivel', $POST['placa_veiculo']));
	}
	try {
		if (!$insert_manutencao || !$update_veiculo) {
			throw new Exception('Não é possivel processar informações.');
		}
		$_SESSION["msg"] = 'Manutenção registrada com sucesso.';
		header('Location: ../pages/forms/cadastrar_saida_manutencao');
	} catch (Exception $e) {
		$_SESSION["msg"] = $e;
	}
}
function relatorio_final_manutencao($id)
{
	$_SESSION['manutencao'] = array();
	$GLOBALS['Recursos']->fetch_array($GLOBALS['Recursos']->query($GLOBALS['selects']->target_manutencao($id)), function ($dados) {
		if ($dados[4] == 'Aberto') {
			$_SESSION['manutencao'][] = $dados;
			header('Location:../pages/forms/finalizar_manutencao');
		} else {
			$_SESSION['manutencao'][] = $dados;
			header('Location:../pages/relatorios/relatorio_geral_manutencao');
		}
	});
}
function finalizar_manutencao($POST, $id)
{
	$manutencao_update = $GLOBALS['Recursos']->query($GLOBALS['updates']->finalizar_manutencao($POST));
	$veiculo_alterar_status =  $GLOBALS['Recursos']->query($GLOBALS['updates']->mudar_status_veiculo_via_placa('Disponivel', $POST['placa_veiculo']));

	if ($POST["substituto_placa_veiculo"] != 'Veiculo não substituido') {
		$veiculo_alterar_status_substituicao =  $GLOBALS['Recursos']->query($GLOBALS['updates']->mudar_status_veiculo_via_placa('Disponivel', $POST['placa_veiculo']));
	}
	try {
		if (!$manutencao_update || !$veiculo_alterar_status) {
			throw new Exception("Não foi possivel finalizar manutenção.");
		}
		header('Location:../php/request.php?page=manutencao/visuzalizar&id=' . $id . '');
	} catch (Exception $e) {
		$_SESSION["msg"] = $e;
		header('Location:../php/request.php?page=manutencao/visuzalizar&id=' . $id . '');
	}
}
function all_manutencao($pagina)
{
	$GLOBALS['Recursos']->paginacao($GLOBALS['Recursos']->query($GLOBALS['selects']->all_saida_manutencoes_relacionamento()), $GLOBALS['selects']->all_saida_manutencoes_relacionamento(), $pagina, function ($dados) {

		if ($dados[4] == 'Aberto') {
			echo "<tr class='danger'>
									<td>" . $GLOBALS['Recursos']->formatdata($dados[5]) . "</td>
									<td>" . $GLOBALS['Recursos']->formatdata($dados[3]) . "</td>
									<td>" . $dados[0] . "</td>
									<td>" . $dados[9] . "</td>
									<td>" . $dados[6] . "</td>
									 <td>" . $dados[8] . "</td>
									<td>" . $dados[4] . "</td>
									<td><a href='../../php/request.php?page=manutencao/visuzalizar&id=" . $dados[0] . "'><i class='material-icons' title='Fechar saida manutenção registrada. '>done_all</i></a></td>
									 <td><a onclick=janela_mensagem('Remover','veiculo','../../php/request.php?page=excluir/manutencao&id=" . $dados[0] . "')><i class='material-icons status_indisponível' title='Remover saida manutenção registrada. '>delete</i></a></td>
									</tr>";
		} else {
			echo "<tr>
										<td>" . $GLOBALS['Recursos']->formatdata($dados[5]) . "</td>
										<td>" . $GLOBALS['Recursos']->formatdata($dados[3]) . "</td>
										<td>" . $dados[0] . "</td>
										<td>" . $dados[9] . "</td>
										<td>" . $dados[6] . "</td>
										 <td>" . $dados[8] . "</td>
										<td>" . $dados[4] . "</td>
										<td><a href='../../php/request.php?page=manutencao/visuzalizar&id=" . $dados[0] . "'><i class='material-icons'  title='Visualizar informações registrada na saida para manutenção . '>done_all</i></a></td>
										 <td><a onclick=janela_mensagem('Excluir','manutenção','../../php/request.php?page=excluir/manutencao&id=" . $dados[0] . "')><i class='material-icons status_indisponível' title='Remover saida manutenção registrada. ' >delete</i></a></td>
										 <td><a onclick=janela_mensagem('Abrir','manuutencao','../../php/request.php?page=abrir/manutencao&id=" . $dados[0] . "')><i class='material-icons 'title='Reabrir saida manutenção registrada. '>lock_open</i></a></td>
										</tr>";
		}
	}, function ($paginas) {
		if ($paginas > 1) {
			for ($i = 1; $i < ($paginas + 1); $i++) {
				echo "<div class='paginacao'><a  href='../../pages/relatorios/relatorio_saida_manutencao?pagina=$i'>" . $i . "</a></div> ";
			}
		}
	});
}
function abrir_manutencao($id)
{
	$manutencao_update = $GLOBALS['Recursos']->query($GLOBALS['updates']->abrir_manutencao($id));
	try {
		if (!$manutencao_update) {
			throw new Exception("Não é possivel abrir manutenção.");
		}
		header('Location: ../pages/relatorios/relatorio_saida_manutencao');
	} catch (Exception $e) {
		header('Location: ../pages/relatorios/relatorio_saida_manutencao?pagina=1');
	}
}
function excluir_manutencao($id)
{

	$GLOBALS['Recursos']->fetch_array($GLOBALS['Recursos']->query($GLOBALS['selects']->target_manutencao_id($id)), function ($dados) {

		$delete = $GLOBALS['Recursos']->query($GLOBALS['deletes']->deletar_manutencao($dados[0]));
		$update =  $GLOBALS['Recursos']->query($GLOBALS['updates']->mudar_status_veiculo_via_id('Disponivel', $dados[7]));

		if ($dados['veiculo_substituicao'] != 'Veiculo não substituido') {
			$update1 =  $GLOBALS['Recursos']->query($GLOBALS['updates']->mudar_status_veiculo_via_placa('Disponivel', $dados[6]));
		}
		try {
			if (!$delete || !$update || !$update1) {
				throw new Exception("Não é possivel deletar manutenção");
			}
			header('Location: ../pages/relatorios/relatorio_saida_manutencao?pagina=1');
		} catch (Exception $e) {
			header('Location: ../pages/relatorios/relatorio_saida_manutencao?pagina=1');
		}
	});
}
