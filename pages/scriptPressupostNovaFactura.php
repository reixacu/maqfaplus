<?php
include "mysql.php";
include "funcions.php";
$idPressupost = $_GET["idPressupost"];
$result = getPressupostData($idPressupost);
$row = $result->fetch_assoc();


$idClient = $row["id_client_factura"];
//$descripcio = $_POST["descripcio"];


$sql = "INSERT INTO `factures` (`id_factura`, `numero_factura`, `data_factura`, `data_venciment_factura`, `pagament_realitzat_factura`, `comentari_factura`, `id_client_factura`, `iva_factura`, `base_imposable_factura`) VALUES (NULL, '', '2000-01-01', '2000-01-01', '0', '', '$idClient', '21', '0');";
if ($conn->query($sql) === TRUE) {
  $resultDadesFactura = getLiniesPressupostData($idPressupost);
  $quantitatElements = getNumRowsDetallsPressupost($idPressupost);
  include "mysql.php";
  $PressupostNum = "Pressupost Num. " . $row["id_factura"];
  $sql111 = "INSERT INTO `detalls_factures` (`id_df`, `id_factura_df`, `descripcio_df`, `unitats_df`, `preu_unitat_df`) VALUES (NULL, ".getLastFacturaId().", '".$PressupostNum."', 0, 0)";

  if ($conn->query($sql111) === TRUE) {
  } else {
      echo "ERROR: " . $sql111 . "<br>" . $conn->error;
  }
  for($i = 0; $i< $quantitatElements; $i++){
  	$rowDadesFactura = $resultDadesFactura->fetch_assoc();
    $desc1 = str_replace("'", "''", $rowDadesFactura['descripcio_df']);
  		// Tipus de línia amb preu quantitat i preu total
      include "mysql.php";
      $sql11 = "INSERT INTO `detalls_factures` (`id_df`, `id_factura_df`, `descripcio_df`, `unitats_df`, `preu_unitat_df`, `preu_total_df`) VALUES (NULL, ".getLastFacturaId().", '". $desc1."', ". $rowDadesFactura['unitats_df'].", ". $rowDadesFactura['preu_unitat_df']." , ". $rowDadesFactura['preu_total_df'].")";

      if ($conn->query($sql11) === TRUE) {
      } else {
          echo "ERROR: " . $sql11 . "<br>" . $conn->error;
      }
    }

    include "mysql.php";
    $sql = "
        UPDATE `pressupostos`
          SET `id_factura_pressupost` =  ".getLastFacturaId()."
          WHERE `pressupostos`.`id_factura` = '$idPressupost';
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

} else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
}
?>
