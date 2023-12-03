<!DOCTYPE html>
<html lang="en">
<?php
    include "../includes/metadata2.php"
?>
<style>
	table {margin:auto;}
	tr {background-color:cyan;}
	tr.par {background-color:pink;}
	tr.impar {background-color:orange;}
	td,th {padding:10px;}
</style>
<body>
    <?php
        include "../includes/header2.php";
        include "../includes/menu2.php";
        include "../includes/nav_basicos.php";
    ?>
    <main>
		<div>
			<?php
			if($_REQUEST) {
				?>
				<a class="links" href="../basicos/index.php">Inicio: basicos</a>
        		<div>
					<?php
                        $cambioDolar=$_GET['cambioDolar'];
                        $cambioLibra=$_GET['cambioLibra'];
                        $fecha=date("d-m-y");
                        echo "<h1 id='centrado'>CAMBIO DE DIVISAS A FECHA $fecha</h1>";
                        echo "<table>";
                        echo "<tr>
                                <th>Euros</th>
                                <th>Dolares</th>
                                <th>Libras</th>
                            </tr>";
                        for ($euro=1; $euro<=10 ; $euro++)
                        {
                            if ($euro%2==0)
                                echo "<tr class='par'>";
                            else
                                echo "<tr class='impar'>";
                            echo "<td>$euro</td>";
                            echo "<td>", $euro*$cambioDolar,"</td>";
                            echo "<td>", $euro*$cambioLibra,"</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
					?>
				</div>
				<?php
			}
			else {
			?>
			<h2 class="h2main">Cambio divisas</h2>
			<form action="3.php" method="GET">
                <p>Cambio de 1 euro a dólares estadounidenses: <input type="number" name="cambioDolar" step="0.0001" min="0" required></p>
				<p>Cambio de 1 euro a libras esterlinas: <input type="number" name="cambioLibra" step="0.0001" min="0" required></p>
				<input type="submit" value="Enviar">
        	</form>
			<?php
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