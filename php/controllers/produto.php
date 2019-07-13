<?php 
	function salvar_produto($POST){
		$salvar_produto = $GLOBALS['Recursos']->Query($GLOBALS['inserts']->Salvar_produto($POST));

		try {
			if(!$salvar_produto){
				throw new Exception("Não foi possivel registrar produto");
			}

			$_SESSION["msg"] = 'Produto cadastrado com sucesso.';
			header('Location: ../pages/forms/cadastrar_produto');
		} catch (Exception $e) {
			$_SESSION["msg"] = $e;
			header('Location: ../pages/forms/cadastrar_produto');
		}
	}
	 function all_produtos($pagina)
	{
		$GLOBALS['Recursos']->paginação($GLOBALS['Recursos']->Query($GLOBALS['selects']->all_produtos()),$GLOBALS['selects']->all_produtos(),$pagina,function($dados){
			echo "<tr>
					<td>".$dados[0]."</td>
					<td>".$dados[1]."</td>
					<td>".$GLOBALS['Recursos']->formatdata($dados[2])."</td>
					<td>".$dados[3]."</td>
					<td>".$dados[4]."</td>
					 <td><a onclick=janela_mensagem('Editar','produto','../../php/request?page=editar/produto&id=".$dados[0]."')><i class='material-icons'>edit</i></a></td>
						<td><a onclick=janela_mensagem('Deletar','Produto','../../php/request?page=deletar/produto&id=".$dados[0]."')><i class='material-icons  status_indisponível'>delete</i></a></td>
				</tr>";	
		},function($paginas){
			if($paginas > 1){
				for($i = 1; $i < $paginas + 1; $i++) { 
				echo "
					<div class='paginação'><a  href='../../pages/relatorios/relatorio_todos_produtos?pagina=$i'>".$i."</a></div>
				"; 
				}
			} 
		});
	}
	function delete_produto($id)
	{
		$GLOBALS['Recursos']->Query($GLOBALS['deletes']->deletar_produto($id));	
	 	header('Location: ../pages/relatorios/relatorio_todos_produtos');
	}
	function select_produto($id)
	{
		$_SESSION['produto'] = array();
		$GLOBALS['Recursos']->fetch_array($GLOBALS['Recursos']->Query($GLOBALS['selects']->target_produto($id)),function($dados){
			$_SESSION['produto'] =$dados;
		});
		header('Location:../pages/forms/editar_produto');
	}
	function update_produto($id,$POST){
		$editar_produto = $GLOBALS['Recursos']->Query($GLOBALS['updates']->editar_produto($POST,$id));
		header('Location: ../pages/relatorios/relatorio_todos_produtos');
	}
	function validar_acesso_pages_produto(){
		if(!isset($_SESSION["produto"])){
			$_SESSION["msg"] = 'Não é possivel acessar página.';
			header("Location: ../../pages/relatorios/relatorio_todos_veiculos");
		}
	}
 ?>