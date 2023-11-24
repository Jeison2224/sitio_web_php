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
        <a href="../bdjardineria/index.php">Inicio: BBDD</a>
        <h2>LOGIN PARA USUARIOS REGISTRADOS</h2>
        <?php
            if($_REQUEST){
                $usuario = $_GET["usuario"];
                $contraseña = $_GET["contraseña"];

                if () {

                }
            }
            else {
                ?>
                <form action="login.php" method="get">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario"><br>
                    <label for="contraseña">Contraseña</label>
                    <input type="text" id="contraseña" name="contraseña"><br>
                    <input type="submit" value="Conectar">
                </form>
            <?php
            }
        ?>
    </main>
    <?php
        include "../includes/aside2.php";
        include "../includes/footer2.php";

        function obtenerUsuario(){
                $cone = mysqli_connect   ("localhost", "jardinero", "jardinero")
                    or die ("no se pudo conectar");

                mysqli_select_db ($cone, "jardineria")
                    or die ("no se pudo seleccionar la bbdd");

                $sql = "SELECT * from usuarios where nombre = '$usuario'";
                $resultado = mysqli_query($cone, $sql)
                or die ("Fallo en la consulta");

                return $resultado;
        }
    ?>
</body>
</html>