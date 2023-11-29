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
        <h2>FORMULARIO DE REGISTRO EN LA BASE DE DATOS</h2>
        <?php
            if($_REQUEST){

                require("conectadb.php");

                $usuario = $_GET["usuario"];
                $contraseña1 = $_GET["contraseña"];
                $contraseña2 = $_GET["contraseñave"];

                $sql = "SELECT * from usuarios where nombre ='$usuario'";
                $resultado = $cone->query($sql) or die("Fallo");
                if(mysqli_num_rows($resultado)==0) {
                    if($_GET["contraseña"] == $_GET["contraseñave"]) {
                        $hash = password_hash($contraseña1, PASSWORD_DEFAULT);
                        $insert = "INSERT INTO usuarios (nombre, clave) VALUES ('$usuario', '$hash')";
                        $cone->query($insert);
                        echo "Usuario registrado correctamente";
                        } else {
                            echo "Las contraseñas no son iguales. <a href='register.php'>Volver</a>";
                        }
                }
                else{
                    echo "Usuario ya registrado";
                }
            }
            else {
                ?>
                <form action="register.php" method="get">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario"><br>
                    <label for="contraseña">Contraseña</label>
                    <input type="password" id="contraseña" name="contraseña"><br>
                    <label for="contraseñave">Vuelve a introducir la contraseña</label>
                    <input type="password" id="contraseñave" name="contraseñave"><br>
                    <input type="submit" value="Enviar">
                </form>
            <?php
            }
        ?>
    </main>
    <?php
        include "../includes/aside2.php";
        include "../includes/footer2.php";
    ?>
</body>
</html>