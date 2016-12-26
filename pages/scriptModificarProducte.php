<?php
$id = $_POST["id"];
$nom = $_POST["nom"];
$preu = $_POST["preu"];

include "mysql.php";
$sql = "UPDATE `productes` SET `nom_base_producte` = \"$nom\", `preu_unitat_base_producte` = '$preu' WHERE `productes`.`id_producte` = $id;";

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