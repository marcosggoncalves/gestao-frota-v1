<?php 
	function salvar_usuario($POST)
	{
		$salvar_usuario = $GLOBALS['Recursos']->Query($GLOBALS['inserts']->salvar_usuario($POST));

		try {
			if(!$salvar_usuario){
				throw new Exception("Não foi possivel registrar usuário.");
			}	
			$_SESSION["msg"] = 'Usuário cadastrado com sucesso.';
			header('Location: ../pages/forms/cadastrar_usuario');
		} catch (Exception $e) {
			$_SESSION["msg"] = $e;
			header('Location: ../pages/forms/cadastrar_usuario');
		}
	}
	function update_usuario($POST)
	{
		$update_usuario = $GLOBALS['Recursos']->Query($GLOBALS['updates']->mudar_informacoes_usuario($POST));
		try {
			if(!$update_usuario){
				throw new Exception("Não foi possivel alterar as informações.");	
			}
			$_SESSION["msg"] = 'Suas informações foram alterada com sucesso.';;
			$_SESSION['user'] = $_POST;
			header('Location: ../pages/forms/editar_usuario');
		} catch (Exception $e) {
			$_SESSION["msg"] = $e;
			header('Location: ../pages/forms/editar_usuario');
		}
	}
	 function todos_usuarios($pagina)
	{
		$GLOBALS['pagina'] = $pagina;

		$GLOBALS['Recursos']->paginação($GLOBALS['Recursos']->Query($GLOBALS['selects']->all_usuarios()),'select*from usuario',$GLOBALS['pagina'],function($dados){
	

			$html = array();

			$html[] = "<tr>
					<td>".$dados[0]."</td>
					<td>".$dados[1]."</td>
					<td>".$dados[2]."</td>
					<td>".$GLOBALS['Recursos']->formatdata($dados[7])."</td>";

			 if($dados[6] == 'Ativo'){
				$html[]= "<td class='status_diponivel'>".$dados[6]."</td>
					 <td class=''><a onclick=janela_mensagem('desativar','usuário','../../php/request.php?page=desativar/usuario&id={$dados[0]}');><i class='material-icons status_diponivel' >lock_open</i></a></td>";
			}else{
				$html[]= "<td class='status_indisponível'>".$dados[6]."</td>
					 <td><a onclick=janela_mensagem('Ativar','usuário','../../php/request.php?page=ativar/usuario&id={$dados[0]}')><i class='material-icons status_indisponível'>lock</i></a></td>";
			}

			$html[]= " <td class=''><a onclick=janela_mensagem('Deletar','usuário','../../php/request.php?page=deletar/usuario&id={$dados[0]}')><i class='material-icons status_indisponível' >delete</i></a></td>
				</tr>";

			foreach ($html as $linhas) {
				echo $linhas;
			}

		},function($paginas)
		{
			if($paginas > 1){
				 for($i = 1; $i < $paginas + 1; $i++) { 
					 echo " <div class='paginação'><a  href='../../pages/relatorios/relatorio_todos_usuarios?pagina=$i'>".$i."</a></div>"; 
				}
			} 
		});
	}
	function ativar_usuario($id){
		$GLOBALS['Recursos']->Query($GLOBALS['updates']->status_usuario($id,'Ativo'));
		header('Location: ../pages/relatorios/relatorio_todos_usuarios');
	}
	function desativar_usuario($id){
		$GLOBALS['Recursos']->Query($GLOBALS['updates']->status_usuario($id,'Desativado'));
			header('Location: ../pages/relatorios/relatorio_todos_usuarios');
	}
	function delete_usuario($id){
		$GLOBALS['Recursos']->Query($GLOBALS['deletes']->deletar_usuario($id));
			header('Location: ../pages/relatorios/relatorio_todos_usuarios');
	}

?>