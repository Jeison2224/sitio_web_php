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
            header("Location: 9.php");
        }
    ?>
    <main>
		<div>
            <h2 class="h2main">Importe pedidos</h2>
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
                    //Versión con importes

                    if (isset($_REQUEST['enviar']))  //Se ha recibido código y nombre del cliente y se procede a obtener y mostrar información de sus pedidos
                    {
                        $menu=$_REQUEST['menu'];
                        //1º Mostramos encabezado con el nombre del cliente y su código:
                        $datoscli=explode(":",$menu);
                        $codigocli=$datoscli[0];
                        $nombrecli=$datoscli[1];
                        echo "<h1>LISTADO DE PEDIDOS DEL CLIENTE $nombrecli <br>CON CÓDIGO  $codigocli</h1><br>";

                        //2º Buscamos los pedidos del cliente cuyo código se ha enviado desde el formulario
                        $sql1="SELECT CodigoPedido, FechaPedido FROM pedidos WHERE pedidos.CodigoCliente='$codigocli' ";
                        $resulconsultapedidos = mysqli_query ($cone,$sql1) or die ("Fallo en la consulta de pedidos");

                        //3º Para cada pedido mostramos sus datos y luego buscamos sus líneas de detalle
                        // y el nombre de cada producto, devolviéndolo todo en una tabla HTML
                        $npedidos = mysqli_num_rows ($resulconsultapedidos);
                        if($npedidos==0)
                            echo "<h1>ESTE CLIENTE NO TIENE REGISTRADO NINGÚN PEDIDO </h1>";
                        else {
                            $imp_total=0;
                            for($fp=1;$fp<=$npedidos;$fp++){
                                $imp_pedido=0;
                                $filapedido = mysqli_fetch_row ($resulconsultapedidos);
                                echo "<table>";
                                echo "<tr>
                                        <th colspan='4'>Pedido código ". $filapedido[0]." de fecha ".$filapedido[1]."</th>
                                    </tr>";
                                echo "<tr>
                                        <th>Nombre del Producto</th>
                                        <th>Precio Unidad</th>
                                        <th>Cantidad</th>
                                        <th>Importe</th>
                                    </tr>";

                                //Obtenemos todos los detallepedidos y nombres de productos del pedido de código $filapedido[0]
                                // y los devolvemos en forma de tabla HTML
                                $sql2="SELECT Nombre,PrecioUnidad,Cantidad FROM detallepedidos NATURAL JOIN productos WHERE detallepedidos.CodigoPedido=$filapedido[0]";
                                $resulconsultadetallespedido=mysqli_query ($cone,$sql2) or die ("Fallo en la consulta de detallepedidos y productos");
                                $ndetalles = mysqli_num_rows ($resulconsultadetallespedido);

                                if ($ndetalles == 0) {
                                    print "<tr>
                                            <td colspan='4'>No se han registrado detalles de este pedido</td>
                                        </tr>";
                                }
                                else{
                                    for($fd = 1; $fd <= $ndetalles; $fd++) {
                                        $filadetalle = mysqli_fetch_row($resulconsultadetallespedido);
                                        print '<tr>';
                                        foreach($filadetalle as $columna) {
                                            echo '<td>',$columna,'</td>';
                                        }
                                        //Además vamos calculando y acumulando el importe de cada detalle del pedido actual
                                        $imp_detalle = $filadetalle[1] * $filadetalle[2];
                                        $imp_pedido += $imp_detalle;
                                            echo '<td>',$imp_detalle,'</td>';
                                        print '</tr>';
                                    }
                                }
                                echo "<tr>
                                        <td colspan='3'>Importe total de este pedido</td>
                                        <td>$imp_pedido</td>
                                    </tr>";
                                echo "</table> <br/>";
                                $imp_total+=$imp_pedido; //Vamos acumlando los importe de los pedidos del cliente, para después poder mostrarlo
                            }
                        echo "<h2>IMPORTE TOTAL DE PEDIDOS DEL CLIENTE:  $imp_total</h2><br>";
                        }
                    }

                    //Sacamos menu de selección para elegir el cliente
                    $consulta = mysqli_query ($cone,"select CodigoCliente,NombreCliente from clientes") or die ("Fallo en la consulta");
                    $nfilas = mysqli_num_rows ($consulta);
                    echo "<h1>Selecciona cliente a consultar</h1><br>";
                    echo "<form  action='9.php' method='get'>";
                    echo "<select name='menu'>";
                        for($f=1;$f<=$nfilas;$f++){
                            $fila = mysqli_fetch_row ($consulta);
                            $datoscli=$fila[0].':'.$fila[1];		//Forma de pasar dos datos en un mismo value y recuperarlos con explode
                            echo "<option value='$datoscli'>";
                            echo $fila[1];
                            echo "</option>";
                        }
                    echo "</select>&nbsp;&nbsp;";
                    echo "<input type='submit' name='enviar' value='Enviar consulta'>";
                    echo "</form>";
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