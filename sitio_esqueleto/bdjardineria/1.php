<!DOCTYPE html>
<html lang="en">
<?php
    include "../includes/metadata2.php"
?>
<body>
    <?php
        include "../includes/header2.php";
        include "../includes/menu2.php";
        include "../includes/nav_bbdd.php";
    ?>
    <main>
		<div>
            <h2 class="h2main">Lista clientes</h2>
            <a href="../bdjardineria/index.php">Inicio: BBDD</a>
			<?php
                $cone = mysqli_connect   ("localhost", "jardinero", "jardinero")
                or die ("no se pudo conectar");

                mysqli_select_db ($cone, "jardineria")
                    or die ("no se pudo seleccionar la bbdd");

                $consulta = "SELECT * from clientes";
                $resultado = mysqli_query($cone, $consulta)
                    or die ("Fallo en la consulta");

                $nfilas = mysqli_num_rows ($resultado);
                if  ($nfilas > 0){
                    print ("<table border='1'>");
                    print ("<tr>");
                    print ("<th>codigo cliente</th>");
                    print ("<th>nombre cliente</th>");
                    print ("<th>nombre contacto</th>");
                    print ("</tr>");

                    for ($i=0; $i<$nfilas; $i++)
                    {
                        $r = mysqli_fetch_array ($resultado);
                        print ("<tr>");
                        print ("<td>" . $r['CodigoCliente'] . "</td>");
                        print ("<td>" . $r['NombreCliente'] . "</td>");
                        print ("<td>" . $r['NombreContacto'] . "</td>");
                        print ("</tr>");
                    }

                    print ("</table>");
                }
                else
                    print ("No hay noticias disponibles");

                mysqli_close    ($cone);
			?>
		</div>
    </main>
    <?php
        include "../includes/aside2.php";
        include "../includes/footer2.php";
    ?>
</body>
</html>