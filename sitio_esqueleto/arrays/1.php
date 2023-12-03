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
            <h2 class="h2main">Array aleatorio</h2>
            <a class="links" href="../arrays/index.php">Inicio: arrays</a>
			<?php
                function generarArrayAleatorio($length, $min, $max)
                {
                    for ($i = 0; $i < $length; $i++) {
                        $array[] = rand($min, $max);
                    }
                    return $array;
                }

                function eliminarRepetidos($array)
                {
                    return array_unique($array);
                }

                function calcularMedia($array)
                {
                    return array_sum($array) / count($array);
                }

                $randomArray = generarArrayAleatorio(50, 1, 100);
                $uniqueArray = eliminarRepetidos($randomArray);
                $average = calcularMedia($uniqueArray);

                print "<br>Array aleatorio: " . implode(", ", $randomArray) . "<br>";
                print "<br>Array sin duplicados: " . implode(", ", $uniqueArray) . "<br>";
                print "<br>Media de los números:".round($average,2)."<br>";
			?>
		</div>
    </main>
    <?php
        include "../includes/aside2.php";
        include "../includes/footer2.php";
    ?>
</body>
</html>