<?php

$dataCompra = $_POST["dataCompra"];
$dataVenciment = $_POST["dataVenciment"];
$pagamentRealitzat = $_POST["pagamentRealitzat"];
$ivaCompra = $_POST["ivaCompra"];
$importIva = $_POST["importIva"];

include "mysql.php";
$sql = "INSERT INTO `compres` (`id_compra`, `data_compra`, `data_venciment_compra`, `pagament_realitzat_compra`, `iva_compra`, `import_iva_compra`) VALUES (NULL, '$dataCompra', '$dataVenciment', '$pagamentRealitzat', '$ivaCompra', '$importIva')";

if ($conn->query($sql) === TRUE) {
    echo "
                            <script>
                            window.location.replace(\"totesCompres.php\");
                            </script>
                            ";
} else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
}
?>
