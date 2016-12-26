<?php
$id = $_POST["id"];
$nom = $_POST["nom"];
$preu = $_POST["preu"];

include "mysql.php";
$sql = "INSERT INTO `productes` (`id_producte`, `nom_base_producte`, `preu_unitat_base_producte`) VALUES ('$id', \"$nom\", '$preu');";

if ($conn->query($sql) === TRUE) {
    echo "
                            <script>
                            window.location.replace(\"productes.php\");
                            </script>
                            ";
} else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
}
?>