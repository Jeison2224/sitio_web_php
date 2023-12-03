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
        if(isset($_POST['logout'])) {
            session_destroy();
            header("Location: 2.php");
        }
    ?>
    <main>
		<div>
            <h2 class="h2main">Productos gama</h2>
            <a class="links" href="../bdjardineria/index.php">Inicio: BBDD</a>
            <div id="loggin">
                <?php
                if(isset($_SESSION['login_id'])){
                    ?>
                    <p>Usuario: <?php echo $_SESSION['usuario'] ?></p>
                    <form action="" method="post">
                        <input type="hidden" name="logout" value="true" />
                        <button>Cerrar sesion</button>
                    </form>
                    <?php
                }
                ?>
            </div>
			<?php

            if(isset($_SESSION['login_id'])) {

                if (isset($_REQUEST['gama'])) {
                    $gama=$_REQUEST['gama'];
                    // Enviar consulta
                    $instruccion = "SELECT CodigoProducto, Nombre, CantidadEnStock FROM  productos WHERE Gama='$gama' ORDER BY Nombre";
                    $resconsulta = mysqli_query($cone, $instruccion)
                        or die("Fallo en la consulta");

                    // Mostrar resultados de la consulta
                    $fecha=date("d-m-Y");
                    echo "<h1>Productos de la gama $gama - Fecha: $fecha </h1><br>";
                    $numreg=mysqli_num_rows($resconsulta);
                    if ($numreg==0) {
                        echo "<h1>Actualmente no existe ningún producto dado de alta en esta gama</h1>";
                    } else {
                        print("<table>");
                        print("<tr>");
                        print("<th>Código producto</th>");
                        print("<th>Nombre</th>");
                        print("<th>CantidadEnStock</th>");
                        print("</tr>");

                        while ($resultado = mysqli_fetch_row($resconsulta)) {  //Otra forma de recorrer todos los registros hasta que mysqli_fetch_row devuelva 'false'
                            print("<tr>");
                            for ($i=0;$i<=2;$i++) {   //Sabiendo que hay 3 campos por registro se pueden imprimir las 3 celdas de cada fila con un bucle
                                print("<td>" .$resultado[$i]. "</td>");
                            }
                            print("</tr>");
                        }

                        print("</table>");
                    }
                    echo "<br><p><a href='2.php'>Realizar nueva consulta</a></p>";
                } else {
                    echo "<h1>Consulta de productos por gama</h1><br>";

                    $instruccion = "SELECT Gama, DescripcionTexto FROM  gamasproductos ORDER BY DescripcionTexto";
                    $resconsulta = mysqli_query($cone, $instruccion)
                        or die("Fallo en la consulta");

                    echo "<form action='2.php' method='GET'>";
                    echo "<p>Elige una de las gamas de productos disponible &nbsp;";
                    echo "<select name='gama'>";

                    $nfilas = mysqli_num_rows($resconsulta);
                    if ($nfilas > 0) {
                        for ($i=1; $i<=$nfilas; $i++) {
                            $resultado = mysqli_fetch_row($resconsulta);
                            echo "<option value='$resultado[0]'>". $resultado[0]."</option>";
                        }
                    }
                    echo "</select></p><br>";
                    echo "<p><input type='submit' name='enviar' value='Enviar consulta'></p>";
                    echo "</form>";
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