<?php
$idClient = $_GET["id"];

include "mysql.php";
include "funcions.php";
$sql = "INSERT INTO `feines` (`id_feina`, `estat_feina`, `id_client_feina`, `inci_feina`, `acabament_feina`, `facturacio_feina`) VALUES (NULL, '1', '$idClient', CURDATE(), '2000-01-01', '2000-01-01');";
if ($conn->query($sql) === TRUE) {
    echo "
                            <script>
                            window.location.replace(\"mostrarFeina.php?id=".getLastFeinaId()."\");
                            </script>
                            ";
} else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
}
?>