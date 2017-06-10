<?php
include "mysql.php";
include "funcions.php";
$idAlbara = $_GET["id"];
$result = getAlbaraData($idAlbara);
$row = $result->fetch_assoc();
$facturaAntiga = $_GET["facturaAntiga"];

$idClient = $row["id_client_factura"];
//$descripcio = $_POST["descripcio"];

$resultDadesFactura = getLiniesAlbaraData($idAlbara);
$quantitatElements = getNumRowsDetallsAlbara($idAlbara);
include "mysql.php";
$AlbaraNum = "Albarà Num. " . $row["id_factura"];
$sql111 = "INSERT INTO `detalls_factures` (`id_df`, `id_factura_df`, `descripcio_df`, `unitats_df`, `preu_unitat_df`) VALUES (NULL, ".$facturaAntiga.", '".$AlbaraNum."', 0, 0)";

if ($conn->query($sql111) === TRUE) {
} else {
    echo "ERROR: " . $sql111 . "<br>" . $conn->error;
}
for($i = 0; $i< $quantitatElements; $i++){
	$rowDadesFactura = $resultDadesFactura->fetch_assoc();
  $desc1 = str_replace("'", "''", $rowDadesFactura['descripcio_df']);
		// Tipus de línia amb preu quantitat i preu total
    include "mysql.php";
    $sql11 = "INSERT INTO `detalls_factures` (`id_df`, `id_factura_df`, `descripcio_df`, `unitats_df`, `preu_unitat_df`, `preu_total_df`) VALUES (NULL, ".$facturaAntiga.", '". $desc1."', ". $rowDadesFactura['unitats_df'].", ". $rowDadesFactura['preu_unitat_df']." , ". $rowDadesFactura['preu_total_df'].")";

    if ($conn->query($sql11) === TRUE) {
    } else {
        echo "ERROR: " . $sql11 . "<br>" . $conn->error;
    }
  }

  include "mysql.php";
  $sql = "
      UPDATE `albarans`
        SET `id_factura_albara` =  ".getLastFacturaId()."
        WHERE `albarans`.`id_factura` = '$idAlbara';
        ";
        if ($conn->query($sql) === TRUE) {
        } else {
            echo "ERROR: " . $sql . "<br>" . $conn->error;
        }

  echo "
                          <script>
                          window.location.replace(\"mostrarFactura.php?id=".getLastFacturaId()."\");
                          </script>
                          ";

?>
