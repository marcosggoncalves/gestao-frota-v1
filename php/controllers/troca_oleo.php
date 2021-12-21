<?php
function todos_veiculos()
{
	$GLOBALS['Recursos']->fetch_array($GLOBALS['Recursos']->Query($GLOBALS['selects']->all_veiculos()), function ($dados) {
		echo "<option value=" . $dados[1] . ">" . $dados[0] . "</option>";
	});
}
function Salvar_troca_oleo($POST)
{
	$salvar_troca = $GLOBALS['Recursos']->Query($GLOBALS['inserts']->salvar_troca_oleo($POST));

	try {
		if (!$salvar_troca) {
			throw new Exception('Não foi possivel sregitrar informações');
		}
		$_SESSION["msg"] = 'Troca de óleo do veiculo registrada com sucesso.';
		header('Location: ../pages/forms/cadastrar_troca_oleo');
	} catch (Exception $e) {
		$_SESSION["msg"] = $e;
		header('Location: ../pages/forms/cadastrar_troca_oleo');
	}
}
function all_troca_oleo($pagina)
{
	$GLOBALS['Recursos']->paginação($GLOBALS['Recursos']->Query($GLOBALS['selects']->troca_oleos()), $GLOBALS['selects']->troca_oleos(), $pagina, function ($dados) {
		$troca = ($dados[1] + $GLOBALS['config']['kilometragem_troca_de_oleo']);
		echo "<tr>
					<td>" . $dados[0] . "</td>
					<td>" . $dados[1] . "</td>
					<td>" . $GLOBALS['Recursos']->formatdata($dados[2]) . "</td>
					<td>" . $dados[4] . "</td>
					<td>" . $troca . " - KM</td>
					<td><a href='../../php/request.php?page=editar/troca&id=" . $dados[0] . "'><i class='material-icons'  title='Visualizar informações registrada na saida para manuntenção . '>edit</i></a></td>
				 <td><a onclick=janela_mensagem('Excluir','Registro','../../php/request.php?page=deletar/troca&id=" . $dados[0] . "')><i class='material-icons status_indisponível' title='Remover saida manuntenção registrada. ' >delete</i></a></td>
				</tr>
			";
	}, function ($paginas) {
		if ($paginas > 1) {
			for ($i = 1; $i < $paginas + 1; $i++) {
				echo "
				<div class='paginação'><a  href='../../pages/relatorios/relatorio_todas_troca_oleo.php?pagina=$i'>" . $i . "</a></div>
				";
			}
		}
	});
}
function deletar_troca_oleo($id)
{
	$delete = $GLOBALS['Recursos']->Query($GLOBALS['deletes']->deletar_troca_oleo($id));
	if (!$delete) {
		header('Location:../pages/relatorios/relatorio_todas_troca_oleo');
	} else {
		header('Location:../pages/relatorios/relatorio_todas_troca_oleo');
	}
}
function editar_troca_oleo_salvar($id, $post)
{
	$update_troca =  $GLOBALS['Recursos']->Query($GLOBALS['updates']->mudar_km_troca_oleo($post, $id));
	if (!$update_troca) {
		header('Location:../pages/relatorios/relatorio_todas_troca_oleo');
	} else {
		header('Location:../pages/relatorios/relatorio_todas_troca_oleo');
	}
}
function selecionar_troca_oleo($id)
{
	$_SESSION['troca_oleo'] = array();
	$GLOBALS['Recursos']->fetch_array($GLOBALS['Recursos']->Query($GLOBALS['selects']->target_troca($id)), function ($dados) {
		$_SESSION['troca_oleo'][] = $dados;
	});
	header('Location:../pages/forms/editar_troca_oleo');
}
function validar_acesso_page_troca_oleo()
{
	if (!isset($_SESSION["troca_oleo"])) {
		$_SESSION["msg"] = 'Não é possivel acessar página.';
		header("Location: ../../pages/relatorios/relatorio_todas_troca_oleo");
	}
}
