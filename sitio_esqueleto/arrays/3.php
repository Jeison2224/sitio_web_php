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
            <h2 class="h2main">Liga de fútbol</h2>
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
                $listaEquipos=array( "F.C. Barcelona"=>82, "Real Madrid"=>84, "Atlético Madrid"=>78, "Valencia"=>75, "Sevilla"=>76, "Villarreal"=>60, "Málaga"=>50, "Espanyol"=>47, "Athletic Bilbao"=>55, "Celta"=>51, "Real Sociedad"=>46, "Rayo Vallecano"=>49, "Getafe"=>36, "Osasuna"=>33, "Elche"=>41, "Deportivo"=>38, "Almería"=>29, "Levante"=>37, "Granada"=>35, "Zaragoza"=>32);

                // Prueba de las funciones
                /*echo "<h2>Array Original:</h2>";
                mostrarArrayComoTabla($listaEquipos);

                echo "<h2>Array Ordenado por Valor:</h2>";
                mostrarArrayOrdenadoPorValor($listaEquipos);

                echo "<h2>Array Ordenado por Índice (Clave):</h2>";
                mostrarArrayOrdenadoPorIndice($listaEquipos);*/

                if (!$_REQUEST) {
                    print "<form action='3.php' method='GET'>";
                    print "<label for='desplegable' style='font-size:12pt;'>Elija el equipo:&nbsp;</label>";
                    print "<select id='desplegable' name='nombreEquipo'>";

                    //Ordenamos el array por clave para que el menú de selección muestre los equipos en orden alfabético
                    ksort($listaEquipos);

                    foreach($listaEquipos as $nombre => $p) {
                        print "<option value='$nombre'>$nombre</option>";
                    }
                    print "</select><br><br>";
                    print "<input type='submit' value='Comprobar'/>";
                    print "</form>";
                    print "<br><br>";

                    mostrarArrayComoTabla($listaEquipos);

                } else {
                    //Obtenemos el nombre del equipo a consultar
                    $nombreEquipo = $_REQUEST["nombreEquipo"];

                    //Obtenemos los puntos del equipo que nos interesa
                    $puntos = $listaEquipos[$nombreEquipo];

                    $lista=$listaEquipos;   //Guardamos la lista en una variable auxiliar para no perder los índices
                    rsort($listaEquipos);   //Este comando ordena la lista de equipos por puntos y convierte el índice a escalar

                    //Se obtiene la posición del equipo en el array convertido a array escalar
                    $posicion = array_search($puntos, $listaEquipos) + 1;

                    //Mostramos los resultados obtenidos
                    print "<br><p>El $nombreEquipo tiene $puntos puntos, ahora mismo es el ".$posicion."º en la clasificación.</p>";
                    print "<br><a href='3.php'>Nueva consulta</a><br>";
                    mostrarArrayOrdenadoPorIndice($lista);
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