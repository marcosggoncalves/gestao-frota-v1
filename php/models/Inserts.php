<?php 
	class inserts {
		public function salvar_manutencao($data)
		{
			return "INSERT INTO saida_para_manutencao VALUES ('0','','".$data["km_saida_veiculo"]."',null,'Aberto',now(),'".$data["placa_veiculo"]."','".$data["id_veiculo"]."','".$data["desc_manutencao"]."')";
		}
		public function salvar_troca_oleo($data)
		{
			return "INSERT INTO controle_troca_oleo VALUES ('0','".$data["km_troca"]."','".$data["data_troca"]."','".$data["id_veiculo"]."')";
		}
		public function salvar_retirada_produto($data)
		{
			return "INSERT INTO controle_saida_entrada_produtos VALUES ('0','".$data["quantidade_retirada"]."',now(),'".$data["id_produto"]."','".$data["id_veiculo"]."')";
		}
		public function salvar_veiculo($data)
		{
			return "INSERT INTO veiculos VALUES ('".$data["placa_veiculo"]."','0','".$data["desc_veiculo"]."','Disponivel','".$data["categoria_veiculo"]."')";
		}
		public function salvar_categoria($data)
		{
			return "INSERT INTO categoria VALUES ('0','".$data["status_categoria"]."','".$data["nome_categoria"]."')";
		}
		public function Salvar_produto($data)
		{
			return "INSERT INTO produtos VALUES ('0','".$data["nome_produto"]."',now(),'".$data["quantidade_produto"]."','".$data["quantidade_produto"]."')";
		}
		public function salvar_usuario($data)
		{
			return "INSERT INTO usuario VALUES ('0','".$data["nome_user"]."','".$data["setor_user"]."','".$data["telefone_user"]."','".$data["email_user"]."','".$data["senha_user"]."','Ativo',null)";
		}
	}
