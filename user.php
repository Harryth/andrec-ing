<?php

session_start();
$page_perm = 8; // Variable that stores the page permissions level

// New SQL connection
require_once 'login.php';
$mysqli = new mysqli($db_hostname,$db_username,$db_password,$db_database);

require_once 'functions.php';

if (isset($_POST['user']) && isset($_POST['pass'])) {

	$user = sanitizeString($mysqli, $_POST['user']);
	#$pass = sanitizeString($mysqli, $_POST['pass']);
	$pass = $_POST['pass'];

	$salt1 = ";*&0@]727{";
	$salt2 = "&%J847Yhk";
	$token = sha1("$salt2$pass$salt1");

	$mysqli -> query("SET NAMES 'utf8'");
	$result = $mysqli -> query("SELECT * FROM users WHERE user = '$user';");

	$row = $result -> fetch_array(MYSQLI_BOTH);

	if ($row['password'] == $token) {
		$_SESSION['usrnm'] = $user;
	}
	else {
		$_SESSION = array();
		if (session_id() != "" || isset($_COOKIE[session_name()]))
		setcookie(session_name(), '', time() - 2592000, '/');
		session_destroy();
		
	}
}

// Fetches for user permissions in database and compares it with page permissions
if(isset($_SESSION['usrnm'])){
	$mysqli = new mysqli($db_hostname,$db_username,$db_password,$db_database);
	$perm = permissions($_SESSION['usrnm'], $page_perm,$mysqli);
}
else {
	$perm = FALSE;
}

?>

<!DOCTYPE html>
<html lang="es-CO">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="Ingeniería, Andrec" />
    <meta name="description" content="Administraci&oacute;n de servicio Andrec" />
    <meta name="author" content="Harold Vallejo" />
    <link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="images/favicon/appleimages/faviconimages/favicon-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="images/favicon/apple-icon-72x72.pimages/faviconng" />
    <link rel="apple-touch-icon" sizes="76x76" href="images/favicon/apple-icon-7images/favicon6x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="images/favicon/apple-icon-11images/favicon4x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="images/favicon/apple-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="images/favicon/apple-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="images/favicon/apple-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-icon-180x180.png" />
    <link rel="icon" type="image/png" sizes="192x192"  href="images/favicon/android-icon-192x192.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png" />
    <link rel="manifest" href="/manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png" />
    <meta name="theme-color" content="#ffffff" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" />
    <link rel="stylesheet" type="text/css" href="css/component.css" />
    <script src="js/modernizr.custom.js"></script>
    <!--Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Men&uacute; Principal</title>
</head>

<body>
    <div>
			<?php
			 if (!isset($_SESSION['usrnm']) || !$perm) {
				 die("<p id='error'>Error, por favor inicie sesi&oacute;n, o int&eacute;ntelo de nuevo <a href='index.html'>aqu&iacute;</a></p>");
			 }
			?>
        <header>
            <nav>
                <span id="logo">
                    <a href="/">
                        <img alt="Andrec Logo" src="images/logo_b.png" height="54" width="235" />
                    </a>
                </span>
                <div id="dl-menu" class="dl-menuwrapper">
                    <button class="dl-trigger">Open Menu</button>
                    <ul class="dl-menu">
                        <li><a href="#">Menu 1</a></li>
                        <li><a href="#">Menu 2</a></li>
                        <li><a href="#">Menu 3</a></li>
                    </ul>
                </div>

                <?php if(isset($_SESSION['usrnm'])) echo "<a href='logout.php' id='logout'><i class=\"fa fa-sign-out\"></i></a>"; ?>
            </nav>
        </header>
			
			<div>
				<?php
				if (permissions($_SESSION['usrnm'],1,$mysqli)) {
					echo <<<_END
					<p>
						<a href="new_report.php">Nuevo Reporte</a>
					</p>
_END;
				}
				if (permissions($_SESSION['usrnm'],2,$mysqli)) {
					echo <<<_END
					<p>
						<a href="find_report.php?findtype=0&search=FALSE">Servicio T&eacute;cnico</a>
					</p>
_END;
				}
				if (permissions($_SESSION['usrnm'],4,$mysqli)) {
					echo <<<_END
					<p>
						<a href="find_report.php?findtype=1&search=FALSE">Finalizar Servicio</a>
					</p>
_END;
				}
				if (permissions($_SESSION['usrnm'],8,$mysqli)) {
					echo <<<_END
					<p>
						<a href="find_report.php?findtype=2&search=TRUE">Ver Reporte</a>
					</p>
_END;
				}
				if (permissions($_SESSION['usrnm'],64,$mysqli)) {
					echo <<<_END
					<p>
						<a href="find_report.php?findtype=4">Editar Reporte</a>
					</p>
_END;
				}
				if (permissions($_SESSION['usrnm'],16,$mysqli)) {
					echo <<<_END
					<p>
						<a href="add_ref.php">Agregar referencia</a>
					</p>
_END;
				}
				if (permissions($_SESSION['usrnm'],32,$mysqli)) {
					echo <<<_END
					<p>
						<a href="add_dist.php">Agregar distribuidor</a>
					</p>
_END;
				}
				if (permissions($_SESSION['usrnm'],128,$mysqli)) {
					echo <<<_END
					<br />
					<p>
						<a href="new_order.php">Registrar Orden de Despacho</a>
					</p>
_END;
				}
				if (permissions($_SESSION['usrnm'],128,$mysqli)) {
					echo <<<_END
					<p>
						<a href="opened_orders.php">Ver &Oacute;rdenes Abiertas</a>
					</p>
_END;
				}
				if (permissions($_SESSION['usrnm'],128,$mysqli)) {
					echo <<<_END
					<p>
						<a href="pbill_assoc.php">Pendientes por Asociar Factura</a>
					</p>
_END;
				}
				if (permissions($_SESSION['usrnm'],128,$mysqli)) {
					echo <<<_END
					<p>
						<a href="send_orders.php">&Oacute;rdenes Despachadas</a>
					</p>
_END;
				}
				?>
				<!--<p class="sl">
					<a href="find_ref.php">Modificar referencia</a>
				</p>-->
				<!--<p class="sl">
				<a href="find_dist.php">Editar distribuidor</a>
				</p>-->
			</div>

			<footer>
				<p>
					&copy; Copyright 2019 - Andrec Corporation
				</p>
				<p>
					Cra 7 No. 72 - 64 Bogot&aacute; - Colombia
				</p>
				<p>
					Tel: +(571) 7 45 4020
				</p>
			</footer>
		</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/jquery.dlmenu.js"></script>
	<script>
        $(function() {
            $( '#dl-menu' ).dlmenu();
        });
    </script>
</body>

</html>

