<?php

session_start();
$page_perm = 1;

require_once 'login.php';
$mysqli = new mysqli($db_hostname,$db_username,$db_password,$db_database);

if(isset($_SESSION['usrnm'])){
	require_once 'user_session.php';
	$mysqli = new mysqli($db_hostname,$db_username,$db_password,$db_database);
	$perm = permissions($_SESSION['usrnm'], $page_perm,$mysqli);
}
else {
	$perm = FALSE;
}

if($perm){
	$mysqli -> query("SET NAMES 'utf8'");
	$result = $mysqli -> query("SELECT id FROM wform ORDER BY id DESC LIMIT 1;");

	$row = $result -> fetch_array(MYSQLI_BOTH);

	$rnum = $row['id'] + 1;

	$_SESSION['rnum'] = $rnum;

	$mysqli -> query("SET NAMES 'utf8'");
	$result = $mysqli -> query("SELECT id,name FROM distributor;");

	$distributors = array();

	while ($row = $result -> fetch_array(MYSQLI_BOTH)) {
		$distributors[$row['id']] = $row['name'];
	}

	$mysqli -> query("SET NAMES 'utf8'");
	$result = $mysqli -> query("SELECT `ref` FROM `references`");

	$refs = array();

	while ($row = $result -> fetch_array(MYSQLI_BOTH)) {
		$refs[] = $row[0];
	}

	$mysqli -> query("SET NAMES 'utf8'");
	$result = $mysqli -> query("SELECT * FROM `service_state`;");

	$service_state = array();

	while ($row = $result -> fetch_array(MYSQLI_BOTH)) {
		$service_state[$row['id']] = $row['state'];
	}
}
?>


<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Formulario Ingreso por Garant&iacute;a No <?php echo $rnum; ?>- La Superbodega </title>
		<meta name="description" content="Formulario garant&iacute;a">
		<meta name="author" content="Harold Vallejo">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		<meta name="robots" content="noindex, nofollow" />

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
		<link rel="stylesheet" type="text/css" href="css/new_report_layout.css" />
		<link rel="stylesheet" type="text/css" href="css/new_report_style.css" />
		<link rel="stylesheet" type="text/css" href="css/new_report_print.css" media="print" />

		<script src="./js/jquery.js"></script>
		<script src="./js/app.js"></script>
	</head>

	<body>
		<div>
			<header>
				<a href="user.php"><img src="images/logoaux.png" alt="logo" /></a>
				<div id="info">
					<p>
						La Superbodega Eshop SAS
					</p>
					<p>
						Cra 13 No. 78 - 47 Bogot&aacute; - Colombia
					</p>
					<p>
						Tel: +(571) 5300978 - Cel: +(57) 3106992673
					</p>
				</div>
			</header>

			<?php if(isset($_SESSION['usrnm'])) echo "<a href='logout.php' id='logout'>Cerrar Sesi&oacute;n</a>"; ?>

			<?php
			 if (!isset($_SESSION['usrnm']) || !$perm) {
				 die("<p id='error'>Error, por favor inicie sesi&oacute;n, o int&eacute;ntelo de nuevo <a href='index.php'>aqu&iacute;</a></p>");
			 }
			?>

			<div>

				<form method="post" action="post_report.php">

					<p>Revisi&oacute;n t&eacute;cnica No <span id="tecRevN"><?php echo $rnum ?></span></p>

					<label for="rdate">Fecha y hora de recepci&oacute;n</label>
					<?php date_default_timezone_set('America/Bogota'); $date = date("Y-m-d"); $time = date("H:i") ?>
					<input type="datetime-local" name="rdate" id="rdate" value=<?php echo $date."T".$time ?> />
					<fieldset>
						<legend>Datos del cliente</legend>

						<div class="CltData">
							<div class="labels">
								<label for="doc">Documento del cliente</label>
								<label for="telNum">Tel&eacute;fono</label>
								<label for="bdate">Fecha de compra</label>
								<label for="serial">Serial No</label>
							</div>
							<div class="inputs">
								<input type="text" name="doc" size="13" maxlength="13" placeholder="Documento" id="doc" required="required" />
								<input type="tel" name="telNum" size="13" maxlength="15" placeholder="Telefono" id="telNum" required="required" />
								<input type="date" name="bdate" placeholder="aaaa-mm-dd" id="bdate" />
								<input type="text" name="serial" placeholder="Serial No" id="serial" required="required" />
							</div>
						</div>
						<div class="CltData">
							<div class="labels">
								<label for="name">Nombre del cliente</label>
								<label for="address">Direcci&oacute;n del cliente</label>
								<label>Proveedor</label>
								<label id="warranty"></label>
							</div>
							<div class="inputs">
								<input type="text" name="name" size="30" maxlength="50" placeholder="Nombre" id="name" required="required" />
								<input type="text" name="address" size="30" maxlength="80" placeholder="Direcci&oacute;n" id="address" required="required" />
								<select name="dist">
									<?php
									foreach ($distributors as $dist_id => $dist) {
										echo "<option value='$dist_id'>$dist</option>\n";
									}
									?>
								</select>
							</div>
						</div>

					</fieldset>

					<fieldset id="prod">
						<legend>Datos del producto</legend>

						<div>
							<label>Referencia del producto</label>
							<select name="ref">
								<?php
									foreach ($refs as $ref) {
										echo "<option value='$ref'>$ref</option>\n";
									}
									?>
							</select>
						</div>
						<br />
						<label for="fail">Falla t&eacute;cnica</label>
						<br />
						<textarea rows="10" cols="110" name="fail" id="fail" required="required" ></textarea>
						<br />
						<label for="state">Estado del producto</label>
						<br />
						<textarea rows="10" cols="110" name="state" id="state" required="required" ></textarea>
						<br />
						<p>Accesorios</p>
						<div id="acc">
							<input type="checkbox" name="charger" value="TRUE" id="cargador" />
							<label for="cargador">Cargador</label>
							<input type="checkbox" name="usb" value="TRUE" id="cableUSB" />
							<label for="cableUSB">Cable USB</label>
							<input type="checkbox" name="otg" value="TRUE" id="cableOTG" />
							<label for="cableOTG">Cable OTG</label>
							<input type="checkbox" name="headp" value="TRUE" id="audifonos" />
							<label for="audifonos">Aud&iacute;fonos</label>
							<input type="checkbox" name="supp" value="TRUE" id="soportecarro" />
							<label for="soportecarro">Soporte carro</label>
							<input type="checkbox" name="orgb" value="TRUE" id="cajaoriginal" />
							<label for="cajaoriginal">Caja original</label>
							<input type="checkbox" name="man" value="TRUE" id="manuales" />
							<label for="manuales">Manuales</label>
							<br />
							<input type="checkbox" name="other" value="TRUE" id="otro" />
							<label for="otro">Otro</label>
							<input type="text" name="otherAcc" placeholder="Otro" id="otherAcc" />

							<br />
							<br />
							<label>Estado del servicio</label>
							<select name="servste">
									<?php
									foreach ($service_state as $servste_id => $servste) {
										echo "<option value='$servste_id'>$servste</option>\n";
									}
									?>
							</select>
						</div>
						<label for="received">Recibido por</label>
						<input type="text" name="received" size="30" maxlength="50" placeholder="Recibido por" required="required" />
					</fieldset>

					<div id="sign">
						<p>__________________________________________</p>
						<p>Nombre y firma del cliente</p>
					</div>

					<input type="submit" value="Enviar" />
				</form>

			</div>

			<footer>
				<p>
					&copy; Copyright 2014 La Superbodega Eshop SAS
				</p>
				<p>
					Cra 13 No. 78 - 47 Bogot&aacute; - Colombia
				</p>
				<p>
					Tel: +(571) 5300978 - Cel: +(57) 3106992673
				</p>
			</footer>
		</div>
	</body>
</html>
