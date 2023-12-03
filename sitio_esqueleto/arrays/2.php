<!DOCTYPE html>
<html lang="en">
<?php
    include "../includes/metadata2.php"
?>
<body>
    <?php
        include "../includes/header2.php";
        include "../includes/menu2.php";
        include "../includes/nav_arrays.php";
    ?>
    <main>
		<div>
            <h2 class="h2main">Ordenacion</h2>
            <a class="links" href="../arrays/index.php">Inicio: arrays</a>
			<?php
                // Función para mostrar los datos del array tal como se reciben
                function mostrarArrayComoTabla($array) {
                    echo "<table style='border: 1px solid grey;'>";
                    echo "<tr><th style='color: green;'>Indice</th><th style='color: green;'>Valor</th></tr>";
                    foreach ($array as $indice => $valor) {
                        echo "<tr style='border: 1px solid grey;'><td style='border: 1px solid grey;color: green;'>$indice</td style='border: 1px solid grey;'><td style='border: 1px solid grey;color: green;'>$valor</td></tr>";
                    }
                    echo "</table>";
                }

                // Función para mostrar los datos del array ordenados descendentemente por valor
                function mostrarArrayOrdenadoPorValor($array) {
                    arsort($array); // Ordenar el array por valor de forma descendente
                    mostrarArrayComoTabla($array);
                }

                // Función para mostrar los datos del array ordenados por índice (clave)
                function mostrarArrayOrdenadoPorIndice($array) {
                    ksort($array); // Ordenar el array por clave
                    mostrarArrayComoTabla($array);
                }

                // Datos de prueba
                $datosPrueba = array(
                    "Manzana" => 5,
                    "Banana" => 3,
                    "Naranja" => 8,
                    "Pera" => 4,
                    "Uva" => 10
                );

                // Prueba de las funciones
                echo "<h2>Array Original:</h2>";
                mostrarArrayComoTabla($datosPrueba);

                echo "<h2>Array Ordenado por Valor:</h2>";
                mostrarArrayOrdenadoPorValor($datosPrueba);

                echo "<h2>Array Ordenado por Índice (Clave):</h2>";
                mostrarArrayOrdenadoPorIndice($datosPrueba);
			?>
		</div>
    </main>
    <?php
        include "../includes/aside2.php";
        include "../includes/footer2.php";
    ?>
</body>
</html>