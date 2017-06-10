<?php
$idClient = $_GET["idClient"];
//$descripcio = $_POST["descripcio"];

include "mysql.php";
include "funcions.php";
$sql = "INSERT INTO `factures` (`id_factura`, `numero_factura`, `data_factura`, `data_venciment_factura`, `pagament_realitzat_factura`, `comentari_factura`, `id_client_factura`, `iva_factura`, `base_imposable_factura`) VALUES (NULL, '', '2000-01-01', '2000-01-01', '0', '', '$idClient', '21', '0');";
if ($conn->query($sql) === TRUE) {
    echo "
                            <script>
                            window.location.replace(\"mostrarFactura.php?id=".getLastFacturaId()."\");
                            </script>
                            ";
} else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
}
?>
