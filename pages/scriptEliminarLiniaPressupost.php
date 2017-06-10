<?php
$idLinia = $_POST["idDf"];
$idFactura = $_POST["idFactura"];

include "mysql.php";

$sql = "DELETE FROM `detalls_pressupostos` WHERE `detalls_pressupostos`.`id_df` = $idLinia;";


if ($conn->query($sql) === TRUE) {
    echo "
                            <script>
                            window.location.replace(\"mostrarPressupost.php?id=".$idFactura."\");
                            </script>
                            ";
} else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
}
?>
