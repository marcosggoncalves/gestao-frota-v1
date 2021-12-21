<?php 
	class deletes{
		public function deletar_usuario($id)
		{
			return 'delete from usuario where id_usuario ='.$id.'';
		}
		public function deletar_manuntencao($id)
		{
			return 'delete from saida_para_manuntencao where id_saida_manuntencao = '.$id.'';
		}
		public function deletar_troca_oleo($id)
		{
			return 'delete from controle_troca_oleo where id_controle_troca_oleo = '.$id.'';
		}
		public function deletar_veiculo($id)
		{
			return 'delete from veiculos where id_veiculo = '.$id.'';
		}
		public function deletar_produto($id)
		{
			return 'delete from produtos where id_produto = '.$id.'';
		}
	}
