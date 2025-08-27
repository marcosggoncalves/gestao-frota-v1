<!-- controller -->
<?php include '../../php/autoload.php'; ?>
<?= validar_acesso_page_manutencao() ?>
<!-- ---------- -->
<!DOCTYPE html>
<html>
<?php include '../componentes/head_page.inc' ?>

<body>
	<?php include '../componentes/header.inc' ?>
	<main>
		<?php include '../componentes/sidebar.inc' ?>
		<div class="content">
			<div class="box-dados">
				<div class="form_registrar">
					<form name="form" action="../../php/request.php?page=finalizar/manutencao&id=<?= $_SESSION['manutencao'][0]['id_saida_manutencao'] ?>" method="post">
						<div class="box-dados-title">
							<h1>Registrar saida manutenção veiculo <b> - (<?= $_SESSION['manutencao'][0]['placa_veiculo'] ?>)</b></h1>
						</div>
						<div class="container-input">
							<label>Cód manutenção:</label>
							<input type="number" name="cod_manutencao" value="<?= $_SESSION['manutencao'][0]['id_saida_manutencao'] ?>" readonly>
						</div>
						<div class="container-input">
							<label fpr="data_manutencao">Data saida:</label>
							<input type="text" name="data_manutencao" id="data_manutencao" value="<?= $_SESSION['manutencao'][0]['data_saida_veiculo'] ?>" readonly>
						</div>
						<div class="container-input">
							<label for="km_saida_manutencao">KM saida (dados editável):</label>
							<input type="text" name="km_saida_manutencao" id="km_saida_manutencao" value="<?= $_SESSION['manutencao'][0]['km_saida_veiculo'] ?>">
						</div>
						<div class="container-input">
							<label for="km_entrada_veiculo">Quilometragem Entrada (dados editável) : </label>
							<input type="text" name="km_entrada_veiculo" id="km_entrada_veiculo" value="<?= $_SESSION['manutencao'][0]['km_retorno_veiculo'] ?>">
						</div>
						<div class="container-input">
							<label for="placa_veiculo">Placa veiculo manutenção:</label>
							<input type="text" name="placa_veiculo" id="placa_veiculo" value="<?= $_SESSION['manutencao'][0]['placa_veiculo'] ?>" readonly>
						</div>
						<div class="container-input">
							<label for="substituto_placa_veiculo">Placa veiculo substituto:</label>
							<input type="text" name="substituto_placa_veiculo" id="substituto_placa_veiculo" value="<?= $_SESSION['manutencao'][0]['veiculo_substituicao'] ?>" readonly>
						</div>
						<div class="container-input">
							<label>Status:</label>
							<input type="text" name="status" value="<?= $_SESSION['manutencao'][0][4] ?>" readonly>
						</div>
						<div class="conjuntos_btns">
							<div>
								<input type="button" name="button" onclick='inputs_name_validar("km_entrada_veiculo")' value="Finalizar manutenção">
							</div>
						</div>
						<div>
							<?php include "../componentes/msg.inc" ?>
						</div>
					</form>
				</div>
			</div>
	</main>
	<?php include '../componentes/footer.inc' ?>
</body>

</html>