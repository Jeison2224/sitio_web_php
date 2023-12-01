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

                require("conectadb.php");

                $usuario = $_GET["usuario"];
                $contraseña = $_GET["contraseña"];

                $sql = "SELECT * from usuarios where nombre ='$usuario'";

                if($resultado = $cone->query($sql)){
                    while($row = $resultado->fetch_array()){
                        $userok = $row["nombre"];
                        $contraok = $row["clave"];
                    }
                    $resultado->close();
                }
                $cone->close();

                if(isset($usuario) && isset($contraseña)){
                    if($usuario == $userok){
                        if (password_verify($contraseña, $contraok)) {
                            $_SESSION['log'] = true;
                            $_SESSION['usuario'] = $usuario;
                            header("Location: index.php");
                        }
                        else {
                            echo "Contraseña incorrecta. Vuleve a <a href='login.php'>introducir</a> tus datos.";
                        }
                    }
                    else {
                        echo "Usuario no registrado en la base de datos, Registrarse <a href='register.php'>aqui.</a>";
                    }
                }
            }
            else {
                ?>
                <form action="login.php" method="get">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario"><br>
                    <label for="contraseña">Contraseña</label>
                    <input type="password" id="contraseña" name="contraseña"><br>
                    <input type="submit" value="Conectar">
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