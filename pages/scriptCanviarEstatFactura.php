<?php
$idFactura = $_POST["idFactura"];
$numeroFactura = $_POST["numeroFactura"];
$dataFactura = $_POST["dataFactura"];
$dataVenciment = $_POST["dataVenciment"];
$ivaFactura = $_POST["ivaFactura"];
$formaPagament = $_POST["formaPagament"];

include "mysql.php";
$sql = "
    UPDATE `factures`
      SET `numero_factura` = '$numeroFactura',
        `data_factura` =  STR_TO_DATE('$dataFactura', '%Y-%m-%d'),
        `data_venciment_factura` = STR_TO_DATE('$dataVenciment', '%Y-%m-%d'),
        `iva_factura` = '$ivaFactura',
        `forma_pagament_factura` = '$formaPagament'
      WHERE `factures`.`id_factura` = '$idFactura';
      ";
//$sql = "UPDATE `productes_feines` SET `nom_pf` = \"$nomPf\", `preu_unitat_pf` = '$preuUnitatPf', `unitats_pf` = '$unitatsPf' WHERE `productes_feines`.`id_feina_pf` = $oldIdFeinaPf AND `productes_feines`.`id_producte_pf` = $oldIdProductePf AND `productes_feines`.`nom_pf` = \"$oldNomPf\"";

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
