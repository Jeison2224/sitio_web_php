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
            header("Location: 7.php");
        }
    ?>
    <main>
		<div>
            <h2 class="h2main">Borrar clientes</h2>
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
                    if (isset($_REQUEST['respuesta']))
                    { /*3ª parte:  se procede a borrar el registro del cliente y, previamente, todos lo registros relacionados en tablas subordinadas*/
                    borrarCliente($_REQUEST['codigo'],$_REQUEST['respuesta']);
                    }
                    else{	/*2ª Parte: se muestran los datos del cliente y se pide confirmación de borrado*/
                        if(isset($_REQUEST['telefono'])){
                            $tel=$_REQUEST['telefono'];
                            mostrarClienteyPreguntarBorrar($tel);
                        }
                        else{ /*1ª parte: se pide el nº de teléfono del cliente*/
                    ?>
                            <form action='<?= $_SERVER['PHP_SELF']?>' method='GET'>	<!--Utilizando array superglobal $_SERVER-->
                                <label>Escribe el teléfono del cliente:</label>
                                <input type='text' name='telefono' value='' pattern='[0-9]{9,11}' size='11'> <!--En vez de usar required haremos uso de header(Location: ) en PHP-->
                                <input type="submit" value="Obtener datos del cliente">
                            </form>
                    <?php
                        }
                    }
                    ?>
                            </main>
                            <aside></aside>
                        </section>
                        <footer></footer>
                    </body>
                    </html>

                    <?php
                    //Funciones auxiliares
                    function mostrarClienteyPreguntarBorrar($tel) {
                        include("conectadb.php");
                        if(!empty($tel)){
                            $consulta = mysqli_query($cone,"SELECT * FROM clientes WHERE telefono='$tel';")
                                or die ("Error al seleccionar cliente");
                                /*Si hubiese varios clientes con el mismo teléfono nos quedaríamos con el primero obtenido*/
                            $fila = mysqli_fetch_assoc($consulta);
                            if($fila==true){
                                echo "<h2>FICHA DEL CLIENTE</h2><br><ul>";
                                foreach($fila as $campo => $dato){
                                    echo "<li>$campo: $dato</li> ";
                                }
                                echo "</ul><br>";
                                echo "<p>¿Quieres eliminar este cliente?</p>";
                                ?>
                                <form action='ejer7.php' method='get'>
                                    <input type="hidden" name="codigo" value='<?php $fila['CodigoCliente']?>'/>
                                    <input type="submit" name ="respuesta" value="Si"/>&nbsp;&nbsp;
                                    <input type="submit" name ="respuesta" value="No"/>
                                </form>
                                <?php
                            }else{
                                echo "<p>El teléfono no pertenece a ningún cliente. <a href='ejer7.php'>VOLVER</a></p>";
                            }
                        }else{
                            /*Si el teléfono está vacío lo volvemos a pedir*/
                            header("Location: ejer7.php"); /* Redirección del navegador */
                        }
                    }

                    function borrarCliente($codigo,$respuesta) {
                        include("conectadb.php");
                        echo "<p>RESULTADOS DE BORRADO DE CLIENTE DE CÓDIGO $codigo.</p>";

                        if($respuesta=="Si"){

                            //Borrado de pagos del cliente
                            mysqli_query($cone,"DELETE FROM pagos WHERE codigoCliente = $codigo;")
                                or die ("Error al borrar pagos del cliente.");
                            echo "Se han borrado los pagos del cliente.<br>";

                            //Borrado de detallepedidos de los distintos pedidos que ha hecho el cliente
                            $query = "DELETE FROM detallepedidos WHERE CodigoPedido IN (SELECT DISTINCT CodigoPedido FROM pedidos WHERE CodigoCliente = $codigo);";
                                /* Y otra forma más de expresar este delete:
                                $query= "DELETE DetallePedidos FROM DetallePedidos NATURAL JOIN Pedidos WHERE Pedidos.CodigoCliente = $codigo;"; */
                            mysqli_query($cone, $query) or die ("Fallo al eliminar los detalles pedidos del cliente $codigo.");
                            echo "Se han borrado los detalles de pedidos del cliente.<br>";

                            //Borrado de pedidos del cliente
                            mysqli_query($cone,"DELETE FROM pedidos WHERE codigoCliente = $codigo;")
                                or die ("Error al borrar pedidos del cliente.");
                            echo "Se han borrado los pedidos del cliente.<br>";

                            //Borrado de cliente de la tabla clientes
                            mysqli_query($cone,"DELETE FROM clientes WHERE codigoCliente = $codigo;")
                                or die ("Error al borrar cliente.");
                            echo "Se ha borrado el cliente de la tabla clientes.<br>";

                            mysqli_close($cone);
                        }else{
                            echo "No se ha borrado el cliente.";
                        }
                        echo "<p><a href='ejer7.php'>VOLVER</a></p>";
                    }
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