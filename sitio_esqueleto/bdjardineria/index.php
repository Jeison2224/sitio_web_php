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
    ?>
    <main>
        <h2 class="h2main">Zona de ejercicios con bases de datos</h2>
        <p class="pmain">Aqui se pueden consultar desde el menú de navegacion algunos de los ejercicios realizados en el módulo sobre programación de acceso a datos con PHP y MySQL. <a href="login.php">identificarse</a> o <a href="register.php">registrarse</a></p>
    </main>
    <?php
        include "../includes/aside2.php";
        include "../includes/footer2.php";
    ?>
</body>
</html>