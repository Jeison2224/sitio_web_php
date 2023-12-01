<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    include "../includes/metadata2.php"
?>
<body>
    <?php
        include "../includes/header2.php";
        include "../includes/menu2.php";
        include "../includes/nav_bbdd.php";
        include("conectadb.php");
    ?>
    <main>
		<div>
            <h2 class="h2main">Estadistica</h2>
            <a href="../bdjardineria/index.php">Inicio: BBDD</a>
			<?php

            if(isset($_SESSION['login_id'])) {


                // Enviar consulta
                $instruccionSQL="SELECT productos.Gama, gamasproductos.DescripcionTexto, COUNT(*) FROM productos INNER JOIN gamasproductos ON productos.Gama=gamasproductos.Gama GROUP BY productos.Gama";
                $resulconsulta = mysqli_query($cone, $instruccionSQL)
                or die("Fallo en la consulta");

                // Mostrar resultados de la consulta
                $nfilas = mysqli_num_rows($resulconsulta);
                if ($nfilas > 0) {
                    print("<table>");
                    print("<tr>");
                    print("<th>Gama</th>");
                    print("<th>Descripción</th>");
                    print("<th>Nº de productos</th>");
                    print("</tr>");

                    for ($i=1; $i<=$nfilas; $i++) {
                        $unafila = mysqli_fetch_row($resulconsulta);
                        print("<tr>");
                        print("<td>" . $unafila[0] . "</td>");
                        print("<td>" . $unafila[1] . "</td>");
                        print("<td>" . $unafila[2] . "</td>");
                        print("</tr>");
                    }
                    print("</table>");
                } else {
                    print("No hay productos");
                }

                // Cerrar conexión
                mysqli_close($cone);
            }
            else {
                echo "Esta sección tiene el acceso restringido a usuarios registrados en la base de datos, por favor <a href='login.php'>identifiquese</a> o <a href='register.php'>registrese</a>";
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