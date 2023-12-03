<!DOCTYPE html>
<html lang="en">
<?php
    include "../includes/metadata2.php"
?>
<body>
    <?php
        include "../includes/header2.php";
        include "../includes/menu2.php";
        include "../includes/nav_arrays.php";
    ?>
    <main>
		<div>
            <h2 class="h2main">Funciones strings</h2>
            <a class="links" href="../arrays/index.php">Inicio: arrays</a><br><br>
			<?php
                $words = ["gato", "perro", "elefante", "jirafa", "tortuga", "leon", "tigre", "loro", "canguro", "pinguino"];

                print "<br><br>Array de strings: " . implode(", ", $words) . "<br><br>";

            // Encuentra la palabra más larga
            $longestWord = "";
            foreach ($words as $word) {
                if (strlen($word) > strlen($longestWord)) {
                    $longestWord = $word;
                }
            }

            // Encuentra la palabra más corta
            $shortestWord = $words[0];
            foreach ($words as $word) {
                if (strlen($word) < strlen($shortestWord)) {
                    $shortestWord = $word;
                }
            }

            // Encuentra palabras con más de 5 letras
            $longWords = [];
            foreach ($words as $word) {
                if (strlen($word) > 5) {
                    $longWords[] = $word;
                }
            }

            // Ordena el array alfabéticamente
            sort($words);

            // Función para invertir palabras
            function inviertePalabras($array)
            {
                $invertedWords = [];
                foreach ($array as $word) {
                    $invertedWords[] = strrev($word);
                }
                return $invertedWords;
            }

            // Invierte las palabras
            $invertedArray = inviertePalabras($words);

            print "Palabra más larga: $longestWord<br><br>";
            print "Palabra más corta: $shortestWord<br><br>";
            print "Palabras con más de 5 letras: " . implode(", ", $longWords) . "<br><br>";
            print "Array ordenado alfabéticamente: " . implode(", ", $words) . "<br><br>";
            print "Palabras invertidas: " . implode(", ", $invertedArray) . "<br><br>";
			?>
		</div>
    </main>
    <?php
        include "../includes/aside2.php";
        include "../includes/footer2.php";
    ?>
</body>
</html>