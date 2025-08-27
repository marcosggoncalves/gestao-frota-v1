
CREATE database controle_sist_v1;

USE controle_sist_v1;

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `status_categoria` varchar(80) DEFAULT NULL,
  `nome_categoria` varchar(100) DEFAULT NULL
);

CREATE TABLE `controle_saida_entrada_produtos` (
  `id_controle_produtos` int(11) NOT NULL,
  `quantidade_retirada` int(11) DEFAULT NULL,
  `data_retirada_produto` datetime DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `id_veiculo` int(11) DEFAULT NULL
);

CREATE TABLE `controle_troca_oleo` (
  `id_controle_troca_oleo` int(11) NOT NULL,
  `km_troca` text,
  `data_troca` datetime DEFAULT NULL,
  `id_veiculo` int(11) DEFAULT NULL
);

CREATE TABLE `produtos` (
    `id_produto` int(11) NOT NULL,
    `nome_produto` varchar(100) DEFAULT NULL,
    `data_produto_recebido` datetime DEFAULT NULL,
    `quantidade_produto` int(11) DEFAULT NULL,
    `quantidade_restante` int(11) DEFAULT NULL
);

CREATE TABLE `saida_para_manutencao` (
  `id_saida_manutencao` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `km_retorno_veiculo` text,
  `km_saida_veiculo` text,
  `data_retorno_veiculo` datetime DEFAULT NULL,
  `status` varchar(80) DEFAULT NULL,
  `data_saida_veiculo` datetime DEFAULT NULL,
  `veiculo_substituicao` varchar(60) DEFAULT NULL,
  `id_veiculo` int(11) DEFAULT NULL,
  `desc_manutencao` text
);

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(100) DEFAULT NULL,
  `setor_usuario` varchar(60) DEFAULT NULL,
  `email_usuario` varchar(45) DEFAULT NULL,
  `telefone_usuario` char(100) DEFAULT NULL,
  `senha_usuario` char(8) DEFAULT NULL,
  `status` varchar(40) DEFAULT NULL,
  `acesso` datetime DEFAULT NULL
);

CREATE TABLE `veiculos` (
  `placa_veiculo` char(8) DEFAULT NULL,
  `id_veiculo` int(11) NOT NULL,
  `descricao_veiculo` text,
  `status` varchar(60) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
);

ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);


ALTER TABLE `controle_saida_entrada_produtos`
  ADD PRIMARY KEY (`id_controle_produtos`),
  ADD KEY `id_produto` (`id_produto`),
  ADD KEY `id_veiculo` (`id_veiculo`);


ALTER TABLE `controle_troca_oleo`
  ADD PRIMARY KEY (`id_controle_troca_oleo`),
  ADD KEY `id_veiculo` (`id_veiculo`);


ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);


ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`id_veiculo`),
  ADD KEY `id_categoria` (`id_categoria`);


ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `controle_saida_entrada_produtos`
  MODIFY `id_controle_produtos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


ALTER TABLE `controle_troca_oleo`
  MODIFY `id_controle_troca_oleo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;


ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


ALTER TABLE `veiculos`
  MODIFY `id_veiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;


ALTER TABLE `controle_saida_entrada_produtos`
  ADD CONSTRAINT `controle_saida_entrada_produtos_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`) ON DELETE CASCADE,
  ADD CONSTRAINT `controle_saida_entrada_produtos_ibfk_2` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculos` (`id_veiculo`) ON DELETE CASCADE;


ALTER TABLE `controle_troca_oleo`
  ADD CONSTRAINT `controle_troca_oleo_ibfk_1` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculos` (`id_veiculo`) ON DELETE CASCADE;

ALTER TABLE `veiculos`
  ADD CONSTRAINT `veiculos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);
COMMIT;


INSERT INTO `usuario` (`id_usuario`, `nome_usuario`, `setor_usuario`, `email_usuario`, `telefone_usuario`, `senha_usuario`, `status`, `acesso`) VALUES
(1, 'Marcos Lopes', 'T.I', 'marcoslopesg7@gmail,com', ' 6798343255', '99510796', 'Ativo', '2019-03-08 07:03:46');