<?php 
	function validar_acesso_page_manuntencao(){
		if(!isset($_SESSION["manuntencao"])){
			$_SESSION["msg"] = 'Não é possivel acessar página.';
			header("Location: ../../pages/relatorios/relatorio_filtro");
		}
	}
	function veiculos_status($camada,$categoria,$busca){
			if($busca == 'Todos'){
				$GLOBALS['Recursos']->fetch_array($GLOBALS['Recursos']->Query($GLOBALS['selects']->all_veiculos_disponiveis()),function($dados){
					echo "<option value=".$dados[1].">".$dados[0].'('.$dados[6].')'."</option>";
				});
			}else{
				$GLOBALS['Recursos']->fetch_array($GLOBALS['Recursos']->Query($GLOBALS['selects']->veiculos_status('Disponivel',$categoria)),function($dados){
					if($camada > 0){
						echo "<option value=".$dados[1].">".$dados[0]."</option>";
					}else{
						echo "<option value=".$dados[0].">".$dados[0]."</option>";
					}
				}); 
			}
	}
	function salvar_manuntencao($POST){

		$insert_manuntencao = $GLOBALS['Recursos']->Query($GLOBALS['inserts']->salvar_manuntencao($POST));

		$update_veiculo =  $GLOBALS['Recursos']->Query($GLOBALS['updates']->mudar_status_veiculo_via_id('Indisponivel',$POST['id_veiculo']));
		
		if($POST["placa_veiculo"] != 'Veiculo não substituido'){
			$update_veiculo_sub =  $GLOBALS['Recursos']->Query($GLOBALS['updates']->mudar_status_veiculo_via_placa('Indisponivel',$POST['placa_veiculo']));
		}
		try {
			 if (!$insert_manuntencao || !$update_veiculo) {
		        throw new Exception('Não é possivel processar informações.');
		    }
		    $_SESSION["msg"] = 'Manuntenção registrada com sucesso.';
			header('Location: ../pages/forms/cadastrar_saida_manuntencao');
		} catch (Exception $e) {
			$_SESSION["msg"] = $e;
		}
	}
	function relatorio_final_manuntencao($id){
		$_SESSION['manuntencao'] = array();
		$GLOBALS['Recursos']->fetch_array($GLOBALS['Recursos']->Query($GLOBALS['selects']->target_manuntencao($id)),function($dados){
			if($dados[4] == 'Aberto'){
				$_SESSION['manuntencao'][] = $dados;
				header('Location:../pages/forms/finalizar_manuntencao');
			}else{
				$_SESSION['manuntencao'][] = $dados;
				header('Location:../pages/relatorios/relatorio_geral_manuntencao');
			}		
		});
	}
	function finalizar_manuntencao($POST,$id){
		$manuntencao_update = $GLOBALS['Recursos']->Query($GLOBALS['updates']->finalizar_manuntencao($POST));
		$veiculo_alterar_status =  $GLOBALS['Recursos']->Query($GLOBALS['updates']->mudar_status_veiculo_via_placa('Disponivel',$POST['placa_veiculo']));

		if($POST["substituto_placa_veiculo"] != 'Veiculo não substituido'){
			$veiculo_alterar_status_substituicao =  $GLOBALS['Recursos']->Query($GLOBALS['updates']->mudar_status_veiculo_via_placa('Disponivel',$POST['placa_veiculo']));
		}
		try {
			if (!$manuntencao_update || !$veiculo_alterar_status) {
				throw new Exception("Não foi possivel finalizar manuntenção.");
			}
			header('Location:../php/request?page=manuntenção/visuzalizar&id='.$id.'');
		} catch (Exception $e) {
			$_SESSION["msg"] = $e;
			header('Location:../php/request?page=manuntenção/visuzalizar&id='.$id.'');
		}
	}
	 function all_manuntencao($pagina)
	 {
		$GLOBALS['Recursos']->paginação($GLOBALS['Recursos']->Query($GLOBALS['selects']->all_saida_manuntencoes_relacionamento()),$GLOBALS['selects']->all_saida_manuntencoes_relacionamento(),$pagina,function($dados){

			if($dados[4] == 'Aberto'){
				echo "<tr class='danger'>
									<td>".$GLOBALS['Recursos']->formatdata($dados[5])."</td>
									<td>".$GLOBALS['Recursos']->formatdata($dados[3])."</td>
									<td>".$dados[0]."</td>
									<td>".$dados[9]."</td>
									<td>".$dados[6]."</td>
									 <td>".$dados[8]."</td>
									<td>".$dados[4]."</td>
									<td><a href='../../php/request.php?page=manuntenção/visuzalizar&id=".$dados[0]."'><i class='material-icons' title='Fechar saida manuntenção registrada. '>done_all</i></a></td>
									 <td><a onclick=janela_mensagem('Remover','veiculo','../../php/request.php?page=excluir/manuntenção&id=".$dados[0]."')><i class='material-icons status_indisponível' title='Remover saida manuntenção registrada. '>delete</i></a></td>
									</tr>";

			}else{
				echo "<tr>
										<td>".$GLOBALS['Recursos']->formatdata($dados[5])."</td>
										<td>".$GLOBALS['Recursos']->formatdata($dados[3])."</td>
										<td>".$dados[0]."</td>
										<td>".$dados[9]."</td>
										<td>".$dados[6]."</td>
										 <td>".$dados[8]."</td>
										<td>".$dados[4]."</td>
										<td><a href='../../php/request.php?page=manuntenção/visuzalizar&id=".$dados[0]."'><i class='material-icons'  title='Visualizar informações registrada na saida para manuntenção . '>done_all</i></a></td>
										 <td><a onclick=janela_mensagem('Excluir','manuntenção','../../php/request.php?page=excluir/manuntenção&id=".$dados[0]."')><i class='material-icons status_indisponível' title='Remover saida manuntenção registrada. ' >delete</i></a></td>
										 <td><a onclick=janela_mensagem('Abrir','manunutencao','../../php/request.php?page=abrir/manuntenção&id=".$dados[0]."')><i class='material-icons 'title='Reabrir saida manuntenção registrada. '>lock_open</i></a></td>
										</tr>";

				

			}
		},function($paginas)
		{
			if($paginas > 1){
				 for($i = 1; $i < ($paginas + 1); $i++) { 
							echo "<div class='paginação'><a  href='../../pages/relatorios/relatorio_saida_manuntencao?pagina=$i'>".$i."</a></div> "; 
					} 
				}
		});
	 } 
	 function abrir_manuntencao($id)
	{
		$manuntencao_update = $GLOBALS['Recursos']->Query($GLOBALS['updates']->abrir_manuntencao($id));
		try {
			if(!$manuntencao_update){
				throw new Exception("Não é possivel abrir manuntenção.");
			}
			header('Location: ../pages/relatorios/relatorio_saida_manuntencao');
		} catch (Exception $e) {
			header('Location: ../pages/relatorios/relatorio_saida_manuntencao?pagina=1');	
		}
	}
	function excluir_manuntencao($id){

		$GLOBALS['Recursos']->fetch_array($GLOBALS['Recursos']->Query($GLOBALS['selects']->target_manuntencao_id($id)),function($dados){

			$delete = $GLOBALS['Recursos']->Query($GLOBALS['deletes']->deletar_manuntencao($dados[0]));
			$update =  $GLOBALS['Recursos']->Query($GLOBALS['updates']->mudar_status_veiculo_via_id('Disponivel',$dados[7]));

			if($dados['veiculo_substituicao'] !='Veiculo não substituido'){
				$update1 =  $GLOBALS['Recursos']->Query($GLOBALS['updates']->mudar_status_veiculo_via_placa('Disponivel',$dados[6]));
			}
			try {
				if (!$delete || !$update || !$update1) {
					throw new Exception("Não é possivel deletar manuntenção");	
				}
				header('Location: ../pages/relatorios/relatorio_saida_manuntencao?pagina=1');
			} catch (Exception $e) {
				header('Location: ../pages/relatorios/relatorio_saida_manuntencao?pagina=1');
			}

		});
	}
 ?>