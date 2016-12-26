<?php
$idLinia = $_POST["idLinia"];
$descripcioPf = $_POST["descripcioPf"];
$unitatsPf = $_POST["unitatsPf"];
$preuUnitatPf = $_POST["preuUnitatPf"];
$idFeina = $_POST["idFeina"];

include "mysql.php";
$sql = "UPDATE `productes_feines` SET `descripcio_pf` = \"$descripcioPf\", `unitats_pf` = '$unitatsPf', `preu_unitat_pf` = '$preuUnitatPf' WHERE `productes_feines`.`id_linia_pf` = $idLinia;";
//$sql = "UPDATE `productes_feines` SET `nom_pf` = \"$nomPf\", `preu_unitat_pf` = '$preuUnitatPf', `unitats_pf` = '$unitatsPf' WHERE `productes_feines`.`id_feina_pf` = $oldIdFeinaPf AND `productes_feines`.`id_producte_pf` = $oldIdProductePf AND `productes_feines`.`nom_pf` = \"$oldNomPf\"";

if ($conn->query($sql) === TRUE) {
    echo "
                            <script>
                            window.location.replace(\"mostrarFeina.php?id=".$idFeina."\");
                            </script>
                            ";
} else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
}
?>
