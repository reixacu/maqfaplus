<?php
$idDf = $_POST["idDf"];
$descripcioDf = $_POST["descripcioDf"];
$unitatsDf = $_POST["unitatsDf"] * 100;
$preuUnitatDf = $_POST["preuUnitatDf"] * 100;
$idFactura = $_POST["idFactura"];

include "mysql.php";
$sql = "UPDATE `detalls_factures` SET `descripcio_df` = \"$descripcioDf\", `unitats_df` = '$unitatsDf', `preu_unitat_df` = '$preuUnitatDf' WHERE `detalls_factures`.`id_df` = $idDf;";
//$sql = "UPDATE `productes_feines` SET `nom_pf` = \"$nomPf\", `preu_unitat_pf` = '$preuUnitatPf', `unitats_pf` = '$unitatsPf' WHERE `productes_feines`.`id_feina_pf` = $oldIdFeinaPf AND `productes_feines`.`id_producte_pf` = $oldIdProductePf AND `productes_feines`.`nom_pf` = \"$oldNomPf\"";

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
