<?php
$id = $_GET["idFactura"];

include "mysql.php";
$sql = "INSERT INTO `detalls_pressupostos` (`id_df`, `id_factura_df`, `descripcio_df`, `unitats_df`, `preu_unitat_df`) VALUES (NULL, '$id', '', '0', '0')";

if ($conn->query($sql) === TRUE) {
    echo "
                            <script>
                            window.location.replace(\"mostrarPressupost.php?id=".$id."\");
                            </script>
                            ";
} else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
}
?>
