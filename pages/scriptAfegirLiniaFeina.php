<?php
$id = $_GET["idFeina"];

include "mysql.php";
$sql = "INSERT INTO `productes_feines` (`id_linia_pf`, `id_feina_pf`, `descripcio_pf`, `unitats_pf`, `preu_unitat_pf`) VALUES (NULL, '$id', 'Línia nova', '1', '0')";

if ($conn->query($sql) === TRUE) {
    echo "
                            <script>
                            window.location.replace(\"mostrarFeina.php?id=".$id."\");
                            </script>
                            ";
} else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
}
?>
