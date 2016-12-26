<?php
$idLinia = $_POST["idLinia"];
$idFeina = $_POST["idFeina"];

include "mysql.php";

$sql = "DELETE FROM `productes_feines` WHERE `productes_feines`.`id_linia_pf` = $idLinia;";


if ($conn->query($sql) === TRUE) {
    echo "
                            <script>
                            window.location.replace(\"mostrarFeina.php?id=".$idFeina."\");
                            </script>
                            ";
} else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
}
?>
