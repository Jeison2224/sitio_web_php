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
		<div>
			<?php
			if($_REQUEST) {
				?>
				<a class="links" href="../basicos/index.php">Inicio: basicos</a>
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
					<p><a href="1.php"><br>Volver al cuestionario</a></p>
				</div>
				<?php
			}
			else {
			?>
			<h2 class="h2main">PHP test</h2>
			<form action="1.php" method="GET">
				<b>Introduce tu nombre:</b> <input type="text" name="nombre"><br><br>
				<b>Introduce tus apellidos:</b> <input type="text" name="apellidos">
				<p><b>Pregunta1: Marca la respuesta correcta</b></p>
				<input type="radio" name="pregunta1" value="a">PHP es un lenguaje de "script" de servidor<br>
				<input type="radio" name="pregunta1" value="b">PHP es un lenguaje de "script" de cliente<br>
				<input type="radio" name="pregunta1" value="c">PHP es un lenguaje fuertemente tipado<br>
				<input type="radio" name="pregunta1" value="d">PHP es un lenguaje de marcas<br>
				<p><b>Pregunta2: Marca la respuesta o respuestas correctas</b></p>
				<input type="checkbox" name="pregunta2a" value="a">Los script PHP son interpretados por los navegadores web<br>
				<input type="checkbox" name="pregunta2b" value="b">Los scripts JavaScript son interpretados por los navegadores web<br>
				<input type="checkbox" name="pregunta2c" value="c">Los scripts PHP no necesitan ser interpretados<br>
				<input type="checkbox" name="pregunta2d" value="d">Los scripts PHP van embebidos dentro del código HTML<br><br>
				<input type="submit" value="Enviar">
				<input type="reset" value="Borrar">
        	</form>
			<?php
			}
			?>
		</div>
    </main>
    <?php
        include "../includes/aside2.php";
        include "../includes/footer2.php";
    ?>
</body>
</html>