<?php
$idClient = $_GET["idClient"];
//$descripcio = $_POST["descripcio"];

include "mysql.php";
include "funcions.php";
$sql = "INSERT INTO `albarans` (`id_factura`, `numero_factura`, `data_factura`, `data_venciment_factura`, `pagament_realitzat_factura`, `comentari_factura`, `id_client_factura`, `iva_factura`, `base_imposable_factura`, `id_factura_albara`) VALUES (NULL, '', '2000-01-01', '$idClient', '21', '0', '0');";
if ($conn->query($sql) === TRUE) {
    echo "
                            <script>
                            window.location.replace(\"mostrarAlbara.php?id=".getLastAlbaraId()."\");
                            </script>
                            ";
} else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
}
?>
