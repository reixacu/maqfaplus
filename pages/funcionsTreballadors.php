<?php

function getTreballadorData($idTreballador)
{
    include "mysql.php";
    $sql = "SELECT * FROM treballadors WHERE id_treballador=$idTreballador;";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}
// retorna el nom d'un treballador donat un ID
function getNomTreballador ($id) {
    $result = getFeinaData($id);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["id_client_feina"];
    }
}


 ?>
