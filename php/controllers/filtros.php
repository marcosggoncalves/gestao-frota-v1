<?php 
	
	function validar_acesso_pages_filtros(){
		if(!isset($_SESSION["dados"]) || !isset($_SESSION["pesquisa"])){
			$_SESSION["msg"] = 'Não é possivel acessar página.';
			header("Location: ../../pages/relatorios/relatorio_filtro");
		}
	}
	function relatorio_mensais_resultados($post){
		$_SESSION['pesquisa'] = $post;
		$_SESSION['dados']  = array();
			if($post['tipo_relatorio'] == 'Produtos Retirados'){
				$GLOBALS['Recursos']->fetch_array($GLOBALS['Recursos']->Query($GLOBALS['selects']->filtro_produtos_retirados($_SESSION['pesquisa'])),function($dados){
						$_SESSION['dados'][] = "<tr>
												<td>".$GLOBALS['Recursos']->formatdata($dados[2])."</td>
													<td>".$dados[1]."</td>
													<td>".$dados[6]."</td>
												</tr>"; 
					}
				);
				header('Location:../pages/relatorios/relatorio_filtro_produtos_retirados');
			}else if($post['tipo_relatorio'] == 'Saida Manuntenção'){
				$GLOBALS['Recursos']->fetch_array($GLOBALS['Recursos']->Query($GLOBALS['selects']->filtro_saida_manuntencao($_SESSION['pesquisa'])),function($dados){
						$_SESSION['dados'][] ='<tr>
												<td>'.$GLOBALS['Recursos']->formatdata($dados[5]).'</td>
												<td>'.$GLOBALS['Recursos']->formatdata($dados[3]).'</td>
												<td>'.$dados[0].'</td>
												<td>'.$dados[8].'</td>
												<td>'.$dados[4].'</td>
												<td><a href="../../php/request.php?page=manuntenção/visuzalizar&id='.$dados[0].'"><i class="material-icons">done_all</i></a></td>
											</tr>';
					}
				);
				print_r($_SESSION['pesquisa']);

				header('Location:../pages/relatorios/relatorio_filtro_saida_manuntenção');
			}else{
				$GLOBALS['Recursos']->fetch_array($GLOBALS['Recursos']->Query($GLOBALS['selects']->filtro_troca_oleo($_SESSION['pesquisa'])),function($dados){
					$troca = ($dados[1]+$GLOBALS['config']['kilometragem_troca_de_oleo']);
						$_SESSION['dados'][] ="<tr>
												<td>".$dados[0]."</td>
												<td>".$dados[1]."</td>
												<td>".$GLOBALS['Recursos']->formatdata($dados[2])."</td>
												<td>".$dados[4]."</td>
												<td>".$troca." - KM</td>
											</tr>"; 
					}
				);
				header('Location:../pages/relatorios/relatorio_filtro_troca_oleo');
			}
	}
 ?>