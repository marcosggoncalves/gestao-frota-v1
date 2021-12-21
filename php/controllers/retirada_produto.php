
<?php

function todos_produtos()
{
	$GLOBALS['Recursos']->fetch_array($GLOBALS['Recursos']->Query($GLOBALS['selects']->all_produtos()), function ($dados) {
		echo "<option value=" . $dados[0] . ">" . $dados[1] . "</option>";
	});
}
function salvar_retirada_produto($POST)
{

	$_SESSION['dados'] = $POST;

	$GLOBALS['Recursos']->fetch_array($GLOBALS['Recursos']->Query($GLOBALS['selects']->target_produto($_SESSION['dados']["id_produto"])), function ($produto) {
		$_SESSION['produto'] =  $produto;

		$GLOBALS['Recursos']->fetch_array($GLOBALS['Recursos']->Query($GLOBALS['selects']->target_produto_count($_SESSION['dados']["id_produto"])), function ($registros_produto_retirado) {
			if ($_SESSION['dados']['quantidade_retirada'] > 0) {
				if ($_SESSION['dados']['quantidade_retirada'] > $_SESSION['produto'][3] && $_SESSION['dados']['quantidade_retirada'] > $_SESSION['produto'][4]) {
					$_SESSION['msg'] = 'Quantidade não disponivel para retirada.';
					header('Location: ../pages/forms/cadastrar_retirada_produto');
					return;
				} else {
					if ($_SESSION['produto'][4] == 0) {
						if ($registros_produto_retirado[0] >= $_SESSION['produto'][3]) {
							$_SESSION['msg'] = 'Produto esgotou no estoque.';
							header('Location: ../pages/forms/cadastrar_retirada_produto');
							return;
						} else {
							$diferenca = ($_SESSION['produto'][3] - $_SESSION['dados']['quantidade_retirada']);
						}
					} else {
						$diferenca = ($_SESSION['produto'][4] - $_SESSION['dados']['quantidade_retirada']);
					}
					$salvar_retirada_produto = $GLOBALS['Recursos']->Query($GLOBALS['inserts']->salvar_retirada_produto($_SESSION['dados']));
					$restante = ($_SESSION['produto'][4] + $_SESSION['dados']['quantidade_retirada']);

					$quantidade_restante_produto = $GLOBALS['Recursos']->Query($GLOBALS['updates']->mudar_quantidade_restante_produto($diferenca, $_SESSION['produto'][0]));

					try {
						if (!$quantidade_restante_produto) {
							throw new Exception("Não foi possivel realizar o calculo da quantidade restante do produto.");
						}
						if (!$salvar_retirada_produto) {
							throw new Exception("Não foi possivel registrar retirada de produto.");
						}
						$_SESSION["msg"] = 'Retirada de ' . $_SESSION['produto'][1] . ', registrada com sucesso, restam  ' . $diferenca . ' no estoque.';
						header('Location: ../pages/forms/cadastrar_retirada_produto');
					} catch (Exception $e) {
						$_SESSION["msg"] = $e;
						header('Location: ../pages/forms/cadastrar_retirada_produto');
					}
				}
			} else {
				$_SESSION['msg'] = 'Quantidade não permitida.';
				header('Location: ../pages/forms/cadastrar_retirada_produto');
			}
		});
	});
}
function all_produtos_retirados($pagina)
{
	$GLOBALS['Recursos']->paginação($GLOBALS['Recursos']->Query($GLOBALS['selects']->produtos_retirados()), $GLOBALS['selects']->produtos_retirados(), $pagina, function ($dados) {
		echo "<tr>
				<td>" . $GLOBALS['Recursos']->formatdata($dados[2]) . "</td>
				<td>" . $dados[1] . "</td>
				<td>" . $dados[6] . "</td>
				<td>" . $dados[10] . "</td>
			</tr>";
	}, function ($paginas) {
		if ($paginas > 1) {
			for ($i = 1; $i < $paginas + 1; $i++) {
				echo " <div class='paginação'><a  href='../../pages/relatorios/relatorio_retirada_produto.php?pagina=$i'>" . $i . "</a></div>";
			}
		}
	});
}

?>