<?php
$idFactura = $_GET["idFactura"];
$estatAnteriorPagament = 0;
include "mysql.php";
$sql = "
    UPDATE `factures`
      SET `pagament_realitzat_factura` = '$estatAnteriorPagament'
      WHERE `factures`.`id_factura` = '$idFactura';
      ";

if ($conn->query($sql) === TRUE) {
    echo "
                            <script>
                            window.location.replace(\"facturesNoCobrades.php\");
                            </script>
                            ";
} else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
}
?>
