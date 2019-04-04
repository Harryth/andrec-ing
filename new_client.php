<?php

session_start();
$page_perm = 127; // Variable that stores the page permissions level

// New SQL connection
require_once 'login.php';
$mysqli = new mysqli($db_hostname,$db_username,$db_password,$db_database);

require_once 'functions.php';

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
    <meta name="description" content="Creación de nuevo cliente" />
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
    <!--Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Men&uacute; Principal</title>
</head>

<body>
    <div>
			<?php
			 if (!isset($_SESSION['usrnm']) || !$perm) {
				 die("<p id='error'>Error, por favor inicie sesi&oacute;n, o int&eacute;ntelo de nuevo <a href='index.php'>aqu&iacute;</a></p>");
			 }
			?>
        <header>
            <nav>
                <span id="logo">
                    <a href="/"></a>
                </span>
                <div class="menu">
                    <ul class="list">
                        <li><a href="#">Menu 1</a></li>
                        <li><a href="#">Menu 2</a></li>
                        <li><a href="#">Menu 3</a></li>
                    </ul>
                </div>

                <?php if(isset($_SESSION['usrnm'])) echo "<a href='logout.php' id='logout'><i class=\"fa fa-sign-out\"></i></a>"; ?>
            </nav>
        </header>


        <?php
        if (isset($_POST['clinic'])) {

	$clinic = sanitizeString($mysqli, $_POST['clinic']);
    $nit = sanitizeString($mysqli, $_POST['nit']);
    $address = sanitizeString($mysqli, $_POST['address']);
    $city = sanitizeString($mysqli, $_POST['city']);

    $contact = sanitizeString($mysqli, $_POST['contact']);
    $phone = sanitizeString($mysqli, $_POST['phone']);
    $mobile = sanitizeString($mysqli, $_POST['mobile']);
    $email = sanitizeString($mysqli, $_POST['email']);

    //echo "$clinic, $nit, $address, $city, $contact, $phone, $mobile, $email";
    $mysqli -> query("INSERT into clinics (name, address, nit, city_id) VALUES ('$clinic', '$address', '$nit', $city)");

    $clinic_id = $mysqli -> insert_id;

    $mysqli -> query("INSERT into contacts (name, mobile, phone, mail, clinic_id) VALUES ('$contact', '$mobile', '$phone', '$email', $clinic_id)");
}
        ?>

			<div class="form_wrapper">
            <form method="post" action="new_client.php">
                <fieldset class="sec">
                    <legend>Información de la clínica</legend>
                    <label for="clinic">Clínica</label><input type="text" name="clinic" id="clinic" required />
                    <label for="nit">NIT</label><input type="text" name="nit" id="nit" />
                    <label for="address">Direcci&oacute;n</label><input type="text" name="address" id="address" />
                    <label for="city">Ciudad</label>
                    <select name="city">
                    <?php

                    $mysqli = new mysqli($db_hostname,$db_username,$db_password,$db_database);
                    $mysqli -> query("SET NAMES 'utf8'");
                    if($result = $mysqli -> query("SELECT id, name FROM `cities`")){
                        while ($row = $result->fetch_assoc()){
                        printf ("<option value='%s'>%s</option>", $row["id"], $row["name"]);
                    }
                    }
                        else echo "<option value=>Paila</option>"
                    ?>
                    </select>
                    <label for="contact">Contacto</label><input type="text" name="contact" id="contact" required />
                    <label for="mobile">Celular</label><input type="tel" name="mobile" id="mobile" />
                    <label for="phone">Tel&eacute;fono</label><input type="tel" name="phone" id="phone" />
                    <label for="email">e-mail</label><input type="mail" name="email" id="email" />
                </fieldset>

                <input class="form" type="submit">
            </form>
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
</body>

</html>

