<!DOCTYPE html>
<html lang="en">
<?php
    include "../includes/metadata2.php"
?>
<body>
    <?php
        include "../includes/header2.php";
        include "../includes/menu2.php";
        include "../includes/nav_basicos.php";
    ?>
    <main>
		<h2 class="h2main">php test</h2>
		<form action="1.php" method="GET">
            <b>Introduce tu nombre:</b> <input type="text" name="nombre"><br><br>
             <b>Introduce tus apellidos:</b> <input type="text" name="apellidos">
            <p><b>Pregunta1: Marca la respuesta correcta</b></p>
            <input type="radio" name="pregunta1" value="a">PHP es un lenguaje de "script" de servidor<br>
            <input type="radio" name="pregunta1" value="b">PHP es un lenguaje de "script" de cliente<br>
            <input type="radio" name="pregunta1" value="c">PHP es un lenguaje fuertemente tipado<br>
            <input type="radio" name="pregunta1" value="d">PHP es un lenguaje de marcas<br>
            <p><b>Pregunta2: Marca la respuesta o respuestas correctas</b></p>
            <input type="checkbox" name="pregunta2a" value="a">Los script PHP son interpretados por los navegadores web<br>
            <input type="checkbox" name="pregunta2b" value="b">Los scripts JavaScript son interpretados por los navegadores web<br>
            <input type="checkbox" name="pregunta2c" value="c">Los scripts PHP no necesitan ser interpretados<br>
            <input type="checkbox" name="pregunta2d" value="d">Los scripts PHP van embebidos dentro del código HTML<br><br>
            <input type="submit" value="Enviar">
            <input type="reset" value="Borrar">
        </form>
    </main>
    <?php
        include "../includes/aside2.php";
        include "../includes/footer2.php";
    ?>
</body>
</html>