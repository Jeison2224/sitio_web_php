<!DOCTYPE html>
<html lang="en">
<?php
    include "../includes/metadata2.php"
?>
<body>
    <?php
        include "../includes/header2.php";
        include "../includes/menu2.php";
        include "../includes/nav_basicos.php";
    ?>
    <main>
        <a href="../basicos/index.php">Inicio: basicos</a>
        <div>
			<?php
			$nombre = $_GET["nombre"];
			$apellidos = $_GET["apellidos"];
			print "<p>Bienvenido, $nombre $apellidos.</p>";
			if (isset($_GET['pregunta1']) && $_GET["pregunta1"] == "a") {
				print "<p>Respuesta a pregunta 1 correcta.</p>";
			} else {
				print "<p>Respuesta a pregunta 1 incorrecta.</p>";
			}

			if (isset($_GET['pregunta2b'], $_GET['pregunta2d']) && !isset($_GET['pregunta2a']) && !isset($_GET['pregunta2c'])) {
				print "<p>Respuesta a pregunta 2 correcta.</p>";
			} else {
					print "<p>Respuesta a pregunta 2 incorrecta.</p>";
			}
			?>
			<p><a href="form1.php"><br>Volver al cuestionario</a></p>
		</div>
    </main>
    <?php
        include "../includes/aside2.php";
        include "../includes/footer2.php";
    ?>
</body>
</html>