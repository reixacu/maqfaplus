<?php

$idAlbara = $_GET["id"];
$result = getAlbaraData($idAlbara);
$row = $result->fetch_assoc();


$idClient = $row["id_client"];
//$descripcio = $_POST["descripcio"];

include "mysql.php";
include "funcions.php";
$sql = "INSERT INTO `factures` (`id_factura`, `numero_factura`, `data_factura`, `data_venciment_factura`, `pagament_realitzat_factura`, `comentari_factura`, `id_client_factura`, `iva_factura`, `base_imposable_factura`) VALUES (NULL, '', '2000-01-01', '2000-01-01', '0', '', '$idClient', '21', '0');";
if ($conn->query($sql) === TRUE) {
  $resultDadesFactura = getLiniesAlbaraData($idAlbara);
  $quantitatElements = getNumRowsDetallsFactura($idFactura);
  for($i = 0; $i< $quantitatElements; $i++){
  	$rowDadesFactura = $resultDadesFactura->fetch_assoc();
  		// Tipus de línia amb preu quantitat i preu total
  	echo '
  	<tr>
  	<td colspan="4" height="35" style="border-right: solid 1px #000;vertical-align:bottom"> ' . $rowDadesFactura["descripcio_df"] . '</td>
  		<td style="border-right: solid 1px #000;text-align:right"> ' . ($rowDadesFactura["unitats_df"]/100) . '  &nbsp; </td>
  		<td style="border-right: solid 1px #000;text-align:right"> ' . number_format($rowDadesFactura["preu_unitat_df"]/100,2) . ' € &nbsp; </td>
  		<td style="border-right: solid 1px #000;text-align:right"> ' . number_format($rowDadesFactura["preu_total_df"]/100,2) . ' € &nbsp; </td>
  		</tr>
  		';

  	}
    /*echo "
                            <script>
                            window.location.replace(\"mostrarFactura.php?id=".getLastFacturaId()."\");
                            </script>
                            ";*/
} else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
}
?>
