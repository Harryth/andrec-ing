<?php
session_start();
$_SESSION = array();
if (session_id() != "" || isset($_COOKIE[session_name()]))
setcookie(session_name(), '', time() - 2592000, '/');
session_destroy();
?>

<!DOCTYPE html>
<html lang="es-CO">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="Ingeniería, Andrec" />
    <meta name="description" content="Administración de servicio Andrec" />
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
    <link rel="stylesheet" type="text/css" href="css/login_style.css" />
    <link rel="stylesheet" type="text/css" href="css/login_layout.css" />
    <title>Inicio Sesi&oacute;n</title>
</head>

	<body>
		<div>
			<header>
				<div id="logo"><a href="index.php"><img src="images/logo.png" alt="logo" /></a></div>
			</header>
			
			<p id="error">Sesi&oacute;n cerrada con &eacute;xito</p>

			<footer>
				<p>
					&copy; Copyright Andrec Corporation
				</p>
				<p>
					Cra 7 No. 72 - 64 Bogot&aacute; - Colombia
				</p>
				<p>
					Tel: +(571) 745 4020
				</p>
			</footer>
		</div>
	</body>
</html>
