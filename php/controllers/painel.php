<?php 
	function estatisticas($estatistica){
		if ($estatistica == 'troca') {
			return $GLOBALS['Recursos']->contador_registros($GLOBALS['selects']->all_trocas_oleo());
		}else if ($estatistica == 'produtos_retirado') {
			return $GLOBALS['Recursos']->contador_registros($GLOBALS['selects']->all_saida_produtos());
		}else if ($estatistica == 'saida') {
			return $GLOBALS['Recursos']->contador_registros($GLOBALS['selects']->all_saida_manuntencoes());
		}else if ($estatistica == 'veiculos_Indisponivel') {
			return $GLOBALS['Recursos']->contador_registros($GLOBALS['selects']->all_veiculos_indisponiveis());
		}else{
			return $GLOBALS['Recursos']->contador_registros($GLOBALS['selects']->all_veiculos_disponiveis());		
		}
	}
	function substituiçao_veiculos(){
		$GLOBALS['Recursos']->fetch_array($GLOBALS['Recursos']->Query($GLOBALS['selects']->all_veiculos_substituicao()),
			function($dados){
				echo "<tr class='danger'>
						<td>".$dados[6]."</td>
						<td>".$dados[9]."</td>
						<td>".$dados[5]."</td>
						<td>".$GLOBALS['Recursos']->data_diferença($dados[5],date('Y-m-d H:i:s'))."</td>
						<td>".$dados[4]."</td>
				</tr>";
		}); 
	}
	function produtos_retirados(){
		$GLOBALS['Recursos']->fetch_array($GLOBALS['Recursos']->Query($GLOBALS['selects']->all_produtos_retirados()),function($dados){
			echo "<tr>
					<td>".$dados[2]."</td>
					<td>".$dados[1]."</td>
					<td>".$dados[6]."</td>
					<td>".$dados[10]."</td>
			</tr>";
		}); 
	}
 ?>