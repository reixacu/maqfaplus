<?php
$idFactura = $_GET["idFactura"];
$estatAnteriorPagament = $_GET["estatPagament"];
if ($estatAnteriorPagament==0) $estatAnteriorPagament = 1;
else if ($estatAnteriorPagament==1) $estatAnteriorPagament = 0;
include "mysql.php";
$sql = "
    UPDATE `factures`
      SET `pagament_realitzat_factura` = '$estatAnteriorPagament'
      WHERE `factures`.`id_factura` = '$idFactura';
      ";

if ($conn->query($sql) === TRUE) {
    echo "
                            <script>
                            window.location.replace(\"mostrarFactura.php?id=". $idFactura ."\");
                            </script>
                            ";
} else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
}
?>
