<?php
$cone = mysqli_connect   ("localhost", "root", "")
    or die ("no se pudo conectar");
mysqli_select_db ($cone, "jardineria")
    or die ("no se pudo seleccionar la bbdd");
?>