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
                    $cantidad = $_GET["cantidad"];
                    $moneda = $_GET["moneda"];

                    // Valores de cambio
                    $cambioDolares = 1.0543;
                    $cambioLibras = 0.8678;

                    $resultado = 0;
                    $monedaDestino = "";

                    if ($moneda === "dolares") {
                        $resultado = $cantidad * $cambioDolares;
                        $monedaDestino = "Dólares USA";
                    } elseif ($moneda === "libras") {
                        $resultado = $cantidad * $cambioLibras;
                        $monedaDestino = "Libras Esterlinas";
                    }

                    // Mostrar el resultado
                    echo "<h2>Resultado de la conversión:</h2>";
                    echo "$cantidad euros son equivalentes a $resultado $monedaDestino<br>";

                    // Enlace para volver a hacer una nueva conversion
                    echo "<a href='2.php'>Hacer otra conversión</a>";
					?>
				</div>
				<?php
			}
			else {
			?>
			<h2 class="h2main">Conversor de Moneda</h2>
			<form action="2.php" method="GET">
                <label for="cantidad">Cantidad de euros a cambiar:</label>
                <input type="text" id="cantidad" name="cantidad" required><br><br>

                <label for="moneda">Selecciona la moneda de destino:</label>
                <select id="moneda" name="moneda" required>
                <option value="dolares">Dólares USA</option>
                <option value="libras">Libras Esterlinas</option>
                </select><br><br>

                <input type="submit" value="Convertir">
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