<?php
$idLinia = $_POST["idDf"];
$idFactura = $_POST["idFactura"];

include "mysql.php";

$sql = "DELETE FROM `detalls_factures` WHERE `detalls_factures`.`id_df` = $idLinia;";


if ($conn->query($sql) === TRUE) {
    echo "
                            <script>
                            window.location.replace(\"mostrarFactura.php?id=".$idFactura."\");
                            </script>
                            ";
} else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
}
?>
