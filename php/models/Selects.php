<?php 

	class selects
	{
		public function all_trocas_oleo()
		{
			return 'select*from controle_troca_oleo';
		}
		public function all_saida_produtos()
		{
			return 'select*from controle_saida_entrada_produtos';
		}
		public function all_produtos()
		{
			return 'select*from produtos order by id_produto desc';
		}
		public function target_produto($id)
		{
			return 'select*from produtos where id_produto = '.$id.'';
		}
		public function target_produto_count($id)
		{
			return "select sum(quantidade_retirada) from controle_saida_entrada_produtos where id_produto=".$id."";
		}
		public function all_saida_manuntencoes()
		{
			return 'select*from saida_para_manuntencao';
		}
		public function all_saida_manuntencoes_relacionamento()
		{
			return 'select*from saida_para_manuntencao,veiculos,categoria where saida_para_manuntencao.id_veiculo = veiculos.id_veiculo and veiculos.id_categoria = categoria.id_categoria order by saida_para_manuntencao.data_saida_veiculo desc ';
		}
		public function all_veiculos_indisponiveis()
		{
			return "select*from veiculos,categoria where veiculos.id_categoria = categoria.id_categoria and  veiculos.status ='Indisponivel'";
		}
		public function all_veiculos_disponiveis()
		{
			return "select*from veiculos,categoria where veiculos.id_categoria = categoria.id_categoria and veiculos.status ='Disponivel'";
		}
		public function all_veiculos_substituicao()
		{
			return 'select*from saida_para_manuntencao,veiculos where saida_para_manuntencao.id_veiculo = veiculos.id_veiculo and saida_para_manuntencao.id_saida_manuntencao and saida_para_manuntencao.status = "Aberto" order by data_saida_veiculo asc limit 10';
		}
		public function all_produtos_retirados()
		{
			return 'select*from controle_saida_entrada_produtos,produtos,veiculos where controle_saida_entrada_produtos.id_produto = produtos.id_produto and controle_saida_entrada_produtos.id_veiculo = veiculos.id_veiculo order by data_retirada_produto desc limit 10';
		}
		public function logar_user($datauser)
		{
			return 'select*from usuario where nome_usuario = "'.$datauser['Usuário'].'" and  senha_usuario = "'.$datauser['senha'].'"';
		}
		public function veiculos_status($status,$categoria)
		{
			return 'select*from veiculos,categoria where veiculos.id_categoria = categoria.id_categoria and categoria.status_categoria  ="'.$categoria.'" and veiculos.status = "'.$status.'"';
		}
		public function all_veiculos()
		{
			return 'select*from veiculos,categoria where veiculos.id_categoria = categoria.id_categoria';
		}
		public function all_categorias()
		{
			return 'select*from categoria';
		}
		public function all_usuarios()
		{
			return 'select*from usuario';
		}
		public function filtro_saida_manuntencao($data)
		{
			return 'select*from saida_para_manuntencao,veiculos where saida_para_manuntencao.id_veiculo = veiculos.id_veiculo and veiculos.id_veiculo and MONTH(data_saida_veiculo) = "'.$data['mes'].'" and YEAR(data_saida_veiculo) = "'.$data['Ano'].'" ';
		}
		public function filtro_produtos_retirados($data)
		{
			return 'select*from controle_saida_entrada_produtos,produtos where controle_saida_entrada_produtos.id_produto = produtos.id_produto and  MONTH(data_retirada_produto) = "'.$data['mes'].'" and YEAR(data_retirada_produto) = "'.$data['Ano'].'"';
		}
		public function filtro_troca_oleo($data)
		{
			return 'select*from controle_troca_oleo,veiculos where controle_troca_oleo.id_veiculo = veiculos.id_veiculo and MONTH(data_troca) = '.$data['mes'].' and YEAR(data_troca) = '.$data['Ano'].' ';
		}
		public function target_manuntencao($id_saida_manuntencao)
		{
			return'select*from saida_para_manuntencao,veiculos where saida_para_manuntencao.id_veiculo = veiculos.id_veiculo and saida_para_manuntencao.id_saida_manuntencao = '.$id_saida_manuntencao.'';
		}
		public function target_manuntencao_id($id)
		{
			return 'SELECT * FROM saida_para_manuntencao where id_saida_manuntencao = "'.$id.'"';
		}
		public function target_troca($id)
		{
			return 'select*from controle_troca_oleo where id_controle_troca_oleo = '.$id.'';
		}
		public function target_veiculo($id)
		{
			return 'select*from veiculos,categoria where veiculos.id_categoria = categoria.id_categoria and id_veiculo = '.$id.'';
		}
		public function produtos_retirados()
		{
			return 'select*from controle_saida_entrada_produtos,produtos,veiculos where controle_saida_entrada_produtos.id_produto = produtos.id_produto and controle_saida_entrada_produtos.id_veiculo = veiculos.id_veiculo  order by produtos.id_produto ';
		}
		public function troca_oleos()
		{
			return 'select*from controle_troca_oleo,veiculos where controle_troca_oleo.id_veiculo = veiculos.id_veiculo order by controle_troca_oleo.id_controle_troca_oleo  desc';
		}
		public function all_veiculos_asc()
		{
			return 'select*from veiculos,categoria where veiculos.id_categoria = categoria.id_categoria order by status asc';
		}
	}
?>