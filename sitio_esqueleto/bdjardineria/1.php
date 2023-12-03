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
            header("Location: 1.php");
        }
    ?>
    <main>
		<div>
            <h2 class="h2main">Lista clientes</h2>
            <a class="links" href="../bdjardineria/index.php">Inicio: BBDD</a><br>
            <div id="loggin">
                <?php
                if(isset($_SESSION['login_id'])){
                    ?>
                    <p>Usuario: <?php echo $_COOKIE['nombre'] ?></p>
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

                    $consulta = "SELECT * from clientes";
                    $resultado = mysqli_query($cone, $consulta)
                        or die("Fallo en la consulta");

                    $nfilas = mysqli_num_rows($resultado);
                    if  ($nfilas > 0) {
                        print("<table border='1'>");
                        print("<tr>");
                        print("<th>codigo cliente</th>");
                        print("<th>nombre cliente</th>");
                        print("<th>nombre contacto</th>");
                        print("</tr>");

                        for ($i=0; $i<$nfilas; $i++) {
                            $r = mysqli_fetch_array($resultado);
                            print("<tr>");
                            print("<td>" . $r['CodigoCliente'] . "</td>");
                            print("<td>" . $r['NombreCliente'] . "</td>");
                            print("<td>" . $r['NombreContacto'] . "</td>");
                            print("</tr>");
                        }

                        print("</table>");
                    } else {
                        print("No hay noticias disponibles");
                    }
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