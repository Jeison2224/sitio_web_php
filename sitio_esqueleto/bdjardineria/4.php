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
            header("Location: 4.php");
        }
    ?>
    <main>
		<div>
            <h2 class="h2main">Clientes por pais</h2>
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
                if (isset($_REQUEST['enviar']))
                {
                    $pais=$_REQUEST['Pais'];
                    // Enviar consulta
                    $instruccion = "SELECT CodigoCliente, NombreCliente, NombreContacto, ApellidoContacto  FROM  clientes WHERE Pais='$pais' ORDER BY CodigoCliente";
                    $resconsulta = mysqli_query ($cone,$instruccion)
                        or die ("Fallo en la consulta");
                    // Mostrar resultados de la consulta
                    echo "<h1>LISTADO  DE CLIENTES DE --".$pais."-- EN BD JARDINERIA</h1><br>";
                    echo "<table>";
                    echo "<tr> <th>CÓDIGO</th> <th>NOMBRE</th> <th>NOMBRE CONTACTO</th> <th>APELLIDO CONTACTO</th> </tr>";
                    while ($resultado = mysqli_fetch_row ($resconsulta))
                    {
                        echo "<tr>";
                        for($i=0;$i<4;$i++){
                            echo"<td>" .$resultado[$i]. "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "</br><a href='4.php'>Realizar nueva consulta</a>";
                }
                else
                {
                    echo "<h1>Consulta de clientes por pais</h1><br>";
                    $instruccion = "SELECT DISTINCT Pais FROM clientes ORDER BY Pais";
                    $resconsulta = mysqli_query ($cone,$instruccion)
                        or die ("Fallo en la consulta");

                    print ("<form action='4.php' method='GET'>");
                    print ("Elige País &nbsp");
                    print ("<select name='Pais'>");
                    $nfilas = mysqli_num_rows ($resconsulta);
                    if ($nfilas > 0)
                    {
                        for ($i=1; $i<=$nfilas; $i++)
                        {
                            $resultado = mysqli_fetch_row ($resconsulta);
                            echo "<option>". $resultado[0]."</option>";
                        }
                    }
                    print ("</select>");
                    print ("<br><br><p><input type='submit' name='enviar' value='Enviar consulta'></p>");
                    print ("</form>");
                }
                // Cerrar conexión
                mysqli_close ($cone);
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