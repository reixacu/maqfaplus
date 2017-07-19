<?php
$idClient = $_GET["idClient"];
//$descripcio = $_POST["descripcio"];

include "mysql.php";
include "funcions.php";
$sql = "INSERT INTO `pressupostos` (`id_factura`, `data_factura`, `id_client_factura`, `iva_factura`, `base_imposable_factura`, `id_factura_pressupost`,`id_albara_pressupost`) VALUES (NULL, CURDATE(), '$idClient', '21', '0', '0','0');";
if ($conn->query($sql) === TRUE) {
    echo "
                            <script>
                              window.location.replace(\"mostrarPressupost.php?id=".getLastPressupostId()."\");
                            </script>
                            ";
} else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
}
?>
