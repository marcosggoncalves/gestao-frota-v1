<?php 


	class updates{
		public function mudar_status_veiculo_via_id($status,$data)
		{
			return "update veiculos set status = '".$status."' where id_veiculo = '".$data."'";
		}
		public function mudar_status_veiculo_via_placa($status,$data)
		{
			return "update veiculos set status = '".$status."' where placa_veiculo = '".$data."' ";
		} 
		public function mudar_quantidade_restante_produto($diferença,$data)
		{
			return"update produtos set quantidade_restante =".$diferença." where id_produto =".$data."";
		}
		public function mudar_informacoes_usuario($data)
		{
			return 'UPDATE usuario  SET nome_usuario = "'.$data["nome_usuario"].'",setor_usuario = "'.$data["setor_usuario"].'",telefone_usuario =" '.$data["telefone_usuario"].'",email_usuario = "'.$data["email_usuario"].'",senha_usuario = "'.$data["senha_usuario"].'" where id_usuario ="'.$data['id_usuario'].'" ';
		}
		public function status_usuario($id,$status)
		{
			return 'update usuario set status = "'.$status.'" where id_usuario ='.$id.' ';
		}
		public function finalizar_manuntencao($data)
		{
			return 'UPDATE saida_para_manuntencao  SET data_retorno_veiculo = now() ,km_retorno_veiculo = "'.$data["km_entrada_veiculo"].'",km_saida_veiculo = "'.$data['km_saida_manuntencao'].'" , status="Fechado" where id_saida_manuntencao ="'.$data['cod_manuntencao'].'" ';
		}
		public function abrir_manuntencao($id)
		{
			return 'UPDATE saida_para_manuntencao  SET status="Aberto" where id_saida_manuntencao ="'.$id.'" ';
		}
		public function mudar_km_troca_oleo($data,$id)
		{
			return "update controle_troca_oleo set km_troca = '".$data['troca']."' where id_controle_troca_oleo = ".$id." ";
		}
		public function editar_veiculo($data,$id)
		{
			return "update veiculos set status = '".$data['status']."', placa_veiculo= '".$data['placa_veiculo']."', descricao_veiculo ='".$data['desc_veiculo']."', id_categoria='".$data['categoria_veiculo']."'  where id_veiculo = '".$id."' ";
		}
		public function editar_produto($data,$id)
		{
			return "update produtos set nome_produto = '".$data['nome_produto']."',quantidade_produto = '".$data['quantidade_produto']."',quantidade_restante = '".$data['quantidade_produto']."' WHERE id_produto = ".$id."";
		}
	}

 ?>