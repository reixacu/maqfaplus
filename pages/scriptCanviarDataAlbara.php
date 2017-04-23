<?php
$idFactura = $_POST["idFactura"];
$dataFactura = $_POST["dataFactura"];
$ivaFactura = $_POST["ivaFactura"];

include "mysql.php";
$sql = "
    UPDATE `albarans`
      SET `data_factura` =  STR_TO_DATE('$dataFactura', '%Y-%m-%d'),
        `iva_factura` = '$ivaFactura'
      WHERE `albarans`.`id_factura` = '$idFactura';
      ";
//$sql = "UPDATE `productes_feines` SET `nom_pf` = \"$nomPf\", `preu_unitat_pf` = '$preuUnitatPf', `unitats_pf` = '$unitatsPf' WHERE `productes_feines`.`id_feina_pf` = $oldIdFeinaPf AND `productes_feines`.`id_producte_pf` = $oldIdProductePf AND `productes_feines`.`nom_pf` = \"$oldNomPf\"";

if ($conn->query($sql) === TRUE) {
    echo "
                            <script>
                            window.location.replace(\"mostrarAlbara.php?id=". $idFactura ."\");
                            </script>
                            ";
} else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
}
?>
