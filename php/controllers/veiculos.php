<?php


function todas_categorias()
{
	$GLOBALS['Recursos']->fetch_array($GLOBALS['Recursos']->Query($GLOBALS['selects']->all_categorias()), function ($dados) {
		echo "<option value=" . $dados[0] . ">" . $dados[1] . '/' . $dados[2] . "</option>";
	});
}
function salvar_veiculo($POST)
{
	$salvar_veiculo = $GLOBALS['Recursos']->Query($GLOBALS['inserts']->salvar_veiculo($POST));
	try {
		if (!$salvar_veiculo) {
			throw new Exception("Não foi possivel registrar veiculo.");
		}
		$_SESSION["msg"] = 'Veiculo cadastrado com sucesso !!!';
		header('Location: ../pages/forms/cadastrar_veiculo');
	} catch (Exception $e) {
		$_SESSION["msg"] = $e;
		header('Location: ../pages/forms/cadastrar_veiculo');
	}
}
function all_veiculos($pagina)
{
	$GLOBALS['Recursos']->paginação($GLOBALS['Recursos']->Query($GLOBALS['selects']->all_veiculos_asc()), $GLOBALS['selects']->all_veiculos_asc(), $pagina, function ($dados) {
		$html = array();
		$html[] = "<tr>
							<td>" . $dados[1] . "</td>
							<td>" . $dados[0] . "</td>
							<td>" . $dados[2] . "</td>";

		if ($dados[3] == 'Disponivel') {
			$html[] =  "<td class='status_diponivel'>" . $dados[3] . "</td>";
		} else {
			$html[] =  "<td class='status_indisponível'>" . $dados[3] . "</td>";
		}

		$html[] =  "<td>" . $dados[7] . "</td>
							<td>" . $dados[6] . "</td>
							<td><a onclick=janela_mensagem('Remover','veiculo','../../php/request.php?page=deletar/veiculo&id=" . $dados[1] . "')><i class='material-icons status_indisponível'>delete</i></a></td>
							<td><a onclick=janela_mensagem('Editar','Veiculo','../../php/request.php?page=editar/veiculo&id=" . $dados[1] . "')><i class='material-icons'>edit</i></a></td>
							</tr>";

		foreach ($html as $tr) {
			echo $tr;
		}
	}, function ($paginas) {
		if ($paginas > 1) {
			for ($i = 1; $i < $paginas + 1; $i++) {
				echo "
				<div class='paginação'><a  href='../../pages/relatorios/relatorio_todos_veiculos?pagina=$i'>" . $i . "</a></div>
				";
			}
		}
	});
}
function deletar_veiculo($id)
{
	$delete = $GLOBALS['Recursos']->Query($GLOBALS['deletes']->deletar_veiculo($id));
	if (!$delete) {
		header('Location: ../pages/relatorios/relatorio_todos_veiculos');
	} else {
		header('Location: ../pages/relatorios/relatorio_todos_veiculos');
	}
}

function editar_veiculo($post, $id)
{
	$editar_veiculo =  $GLOBALS['Recursos']->Query($GLOBALS['updates']->editar_veiculo($post, $id));

	if (!$editar_veiculo) {
		header('Location:../pages/relatorios/relatorio_todos_veiculos');
	} else {
		header('Location:../pages/relatorios/relatorio_todos_veiculos');
	}
}

function target_veiculo($id)
{
	$_SESSION['veiculo'] = array();
	$GLOBALS['Recursos']->fetch_array($GLOBALS['Recursos']->Query($GLOBALS['selects']->target_veiculo($id)), function ($dados) {
		$_SESSION['veiculo'][] = $dados;
	});
	header('Location:../pages/forms/editar_veiculo');
}
function validar_acesso_pages_veiculo()
{
	if (!isset($_SESSION["veiculo"])) {
		$_SESSION["msg"] = 'Não é possivel acessar página.';
		header("Location: ../../pages/relatorios/relatorio_todos_veiculos");
	}
}
