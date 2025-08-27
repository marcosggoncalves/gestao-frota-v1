<?php  
	include 'autoload.php';
	
	$Request = filter_input(INPUT_GET,'page',FILTER_SANITIZE_SPECIAL_CHARS);
	$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_SPECIAL_CHARS);
	$entradas = filter_input_array(INPUT_POST,$_POST);

	if($Request == 'Logar'){
		acessar($entradas);
	}else if($Request == 'Sair'){
		finalizar_sessao();
	}else if($Request ==  'Salvar/Manutenção'){
		salvar_manutencao($entradas);
	}else if($Request == 'Troca/oleo/salvar'){
		Salvar_troca_oleo($entradas);
	}else if($Request == 'Salvar/retirada/produto'){
		salvar_retirada_produto($entradas);
	}else if($Request == 'Salvar/veiculo'){
		salvar_veiculo($entradas);
	}else if($Request == 'Salvar/categoria'){
		salvar_categoria($entradas);
	}else if($Request == 'Salvar/produto'){
		salvar_produto($entradas);
	}else if($Request == 'Salvar/usuario'){
		salvar_usuario($entradas);
	}else if($Request == 'ativar/usuario'){
		ativar_usuario($id);
	}else if($Request == 'deletar/usuario'){
		delete_usuario($id);
	}else if($Request == 'desativar/usuario'){
		desativar_usuario($id);
	}else if($Request == 'relatorio/filtros'){
		relatorio_mensais_resultados($entradas);
	}else if($Request == 'manutencao/visuzalizar'){
		relatorio_final_manutencao($id);
	}else if($Request == 'finalizar/manutencao'){
		finalizar_manutencao($entradas,$id);
	}else if($Request == 'editar/usuario'){
		update_usuario($entradas);
	}else if($Request == 'abrir/manutencao'){
		abrir_manutencao($id);
	}else if($Request == 'excluir/manutencao'){
		excluir_manutencao($id);
	}else if($Request == 'editar/troca'){
		selecionar_troca_oleo($id);
	}else if($Request == 'editar/salvar/troca'){
		editar_troca_oleo_salvar($id,$entradas);
	}else if($Request == 'deletar/troca'){
		deletar_troca_oleo($id);
	}else if($Request == 'editar/veiculo'){
		target_veiculo($id);
	}else if($Request == 'salvar/editar/veiculo'){
		editar_veiculo($entradas,$id);
	}else if($Request == 'deletar/veiculo'){
		deletar_veiculo($id);
	}else if($Request == 'deletar/produto'){
		delete_produto($id);
	}else if($Request == 'editar/produto'){
		select_produto($id);
	}else if($Request == 'editar/salvar/produto'){
		update_produto($id,$entradas);
	}else{
		header('Location: ../pages/relatorios/painel.php');
	}
